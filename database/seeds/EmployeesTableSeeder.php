<?php

use App\Employee;
use App\Position;
use App\User;
use Illuminate\Database\Seeder;
// use Faker\Generator as Faker;
use Faker\Factory as FakerFactory;
// use Faker\Provider\uk_UA\PhoneNumber as PhoneNumber;
// use Faker\Provider\uk_UA\PhoneNumber;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $startCommonTime = microtime(true);

        $startClearTableTime = microtime(true);
        // Очистка таблицы перед новым заполнением    
        DB::table('employees')->delete();   
        $clearTableTime = microtime(true) - $startClearTableTime;
        printf("Удаление из бд выполнялось %.4F сек. \n", $clearTableTime);
        
        $startCreateTime = microtime(true);
        // Переменные 
        $employee_count = env('SEED_EMP_COUNT'); // кол-во сотрудников
        if (!$employee_count){
            $employee_count = 50000;
        }
        $director_count = env('SEED_DIR_COUNT'); // кол-во директоров, root, depth = 0
        if (!$director_count){
            $director_count = 1;
        }
        $depth_tree = env('SEED_DEPTH_TREE'); // глубина вложенности дерева
        if (!$depth_tree){
            $depth_tree = 5;
        }

        // Переменные для цикла заполнения руководителей
        $count = 0; // для участия в цикле, подсчет кол-ва выборки для функции slice
        $for_count = ($employee_count - $director_count) / $depth_tree; //кол-во сотрудников на 1 уровень дерева
        $parent; // переменная для сохранения родителей и использования в след итерации цикла
        $offset = 0; // смещение, необходимо для функции slice

        $faker = new Faker\Generator();
        $faker->addProvider(new Faker\Provider\uk_UA\PhoneNumber($faker));
        $faker->addProvider(new Faker\Provider\en_US\Person($faker));
        $faker->addProvider(new Faker\Provider\Image($faker));
        $faker->addProvider(new Faker\Provider\DateTime($faker));
        $faker->addProvider(new Faker\Provider\Base($faker));
        $faker->addProvider(new Faker\Provider\Internet($faker));

    $formats = array(
        // International format (mobile)
        '38050#######',
        '38066#######',
        '38068#######',
        '38096#######',
        '38067#######',
        '38091#######',
        '38092#######',
        '38093#######',
        '38094#######',
        '38095#######',
        '38096#######',
        '38097#######',
        '38098#######',
        '38063#######',
        '38099#######',
   );

        // Создаем сотрудников
        $users = User::all();
        $positions = Position::all();
        for ($i = 0; $i < $employee_count; $i++){
            $firstname = $faker->firstname;
            $lastname = $faker->lastname;
            $name = $firstname . ' ' . $lastname;
            factory(Employee::class)->create([            
                'name' => $name,
                // 'phone' => $faker->phoneNumber,
                // 'phone' => Faker\Provider\Base::numerify('+38050#######'),
                'phone' => Faker\Provider\Base::numerify($faker->parse(Faker\Provider\Base::randomElement($formats))),
                // 'photo' => $faker->imageUrl($width = 300, $height = 300),
                'photo' => '300x300.jpg',
                'email' => strtolower($firstname . $lastname) .'@' . $faker->freeEmailDomain(),
                // 'salary' => $faker->numberBetween($min = 0, $max = 500),
                'salary' => $faker->randomFloat(3, $min = 0, $max = 500),
                'employed_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
                // 'employed_at' => $faker->dateTime($max = 'now', $timezone = null),       
                'position_id' => $positions->random()->id,
                'admin_created_id' => $users->random()->id,
                'admin_updated_id' => $users->random()->id,
            ]);
        }

        // Создаем заданное кол-во сотрудников
        // factory(Employee::class, $employee_count - $director_count)->create();

        $createTime = microtime(true) - $startCreateTime;
        printf("Создание выполнялось %.4F сек. \n", $createTime);

        $startSeedTime = microtime(true);
        $emp_counter = $employee_count;
        $minID = 0;
        $maxID = 0;

        for( $i = 0; $i < $depth_tree; $i++ ){
            $startOneDepthTime = microtime(true);
            $count = $for_count;                      
            if ( $i == 0 ){
                $count = $director_count;
                $directors = Employee::all()->slice(0, $director_count, true);
                $minID = $directors->first()->id;
                $maxID = $directors->last()->id;
            }
            if ( $i == 1){
                $count = $employee_count / $depth_tree ** 2;
            }
            if ( $i == $depth_tree - 1 ){
                $count =  $employee_count;
            }
            if ( $employee_count != 0 ){
                $employees = Employee::all()->slice($offset, $count, true);
                foreach ($employees as $employee){
                    if ( $i != 0 ) { 
                        $employee->parent_id = rand($minID, $maxID);
                        $employee->save();                       
                    }
                    $employee_count--;
                    $offset++;
                }
                $minID = $employees->first()->id;
                $maxID = $employees->last()->id;
            }
            $oneDepthTime = microtime(true) - $startOneDepthTime;
            printf("level %d выполнялся: %.4F сек. \n", $i+1, $oneDepthTime);
        }

        // fix Tree - добавление индексов rgt lft
        $startfixTreeTime = microtime(true);
        Employee::fixTree();
        $fixTreeTime = microtime(true) - $startfixTreeTime;
        printf("Дерево фиксилось %.4F сек. \n", $fixTreeTime);

        $seedTime = microtime(true) - $startSeedTime;
        printf("Общее наполнение выполнялось %.4F сек. \n", $seedTime);

        $commonTime = microtime(true) - $startCommonTime;
        printf("Общий скрипт выполнялся %.4F сек. \n", $commonTime);
    }
}
