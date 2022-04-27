<html>
<head>
	<title><?php echo "PHP Object Oriented Programming";?></title>
</head>
<body>
<?php
/*
	Object Oriented Programming allows you to model real
	world objects. Every object has attributes and things 
	it can do (Operations / Functions / Methods) You define those 
	things in a class which is a blueprint for creating
	objects.
*/
class Animal implements Singable{

	/* 
		You define attributes like this. The private means
		that only methods in the class can access this data
		public would mean that any code could directly access
		and change the values for these attributes. 
		
		Attributes that are private won't be inherited as you'll see
		but those that are public or protected are
		
		By making sure our data can only be changed by the class 
		operations we are inencapsulating or protecting it.
	*/
	
	protected $name;
	protected $favorite_food;
	protected $sound;
	protected $id;
	
	// A static attribute is shared by every object. If its
	// value changes for one it changes for all
	
	public static $number_of_animals = 0;
	
	// A constant is also shared
	
	const PI = "3.14159";
	
	// You define methods just like you define functions in a class
	
	function getName(){
	
		// To refer to data stored in an object you proceed the name
		// of the attribute with $this->yourAttribute
	
		return $this->name;
	
	}
	
	// A Construtor is used to initialize objects when they are 
	// created or instantiated
	
	function __construct(){
	
		// Generate a random id between 1 and 1000000
		
		$this->id = rand(100, 1000000);
		
		echo $this->id . " has been assigned<br />";
		
		// You access static attributes with Class::$static_att
		
		Animal::$number_of_animals++;
	
	}
	
	// A Destructor is called when all references to the object have 
	// been unset. It cannot receive attributes
	
	public function __destruct(){
	
		echo $this->name . " is being destroyed :(";
	
	}
	
	// You can also use magic setters and getters which are called
	// when an attribute is set, or if its value is asked for
	
	function __get($name){
		
		echo "Asked for " . $name . "<br />";
	
		return $this->$name;
		
	}
	
	
	// If you want to check for a valid attribute you could use switch
	
	function __set($name, $value){
	
		switch($name){
		
			case "name":
				$this->name = $value;
				break;
				
			case "favorite_food":
				$this->favorite_food = $value;
				break;
				
			case "sound":
				$this->sound = $value;
				break;
				
			default : 
				echo $name . "Not Found";
		
		}
		
		echo "Set " . $name . " to " . $value . "<br />";
	
	}
	
	// 2. We will override this method in the subclass
	function run(){
		
		
		echo $this->name . " runs<br />";
		
	}
	
	// 3. To keep a method from being overridden use final
	// You can use final on a class to keep classes from
	// being overridden as well
	
	final function what_is_good(){
		
		echo "Running is Good<br />";
		
	}
	
	// 4. You can use __toString to define what prints when
	// the object is called to print
	
	function __toString(){
		
		return $this->name . " says " . $this->sound .
		" give me some ". $this->favorite_food . " my id is " .
		$this->id . " total animals = " . Animal::$number_of_animals .
		"<br /><br />";
		
	}
	
	// 5. You must define any function defined in an interface
	
	public function sing(){
		
		echo $this->name . " sings 'Grrrr grr grrr grrrrrrrrr'<br />";
		
	}
	
	// 7. static methods can be called without the need for instantiation
	
	static function add_these($num1, $num2){
		
		return ($num1 + $num2) . "<br />";
		
	}
	
}

// Inheritance occurs when you create a new class by extending another
// You will inherit all of the Attributes and Methods defined in the first
// You don't have to do anything in the class and it will still work

class Dog extends Animal implements Singable{
	
	// 2. You can override functions defined in the superclass
	function run(){
		
		
		echo $this->name . " runs like crazy<br />";
		
	}
	
	// 5. You must define any function defined in an interface
	
	public function sing(){
		
		echo $this->name . " sings 'Bow wow, woooow, woooooooooow'<br />";
		
	}
	
	
}

// 5. PHP doesn't allow muliple inheritance
// You need to use interfaces to get similar results
// Interfaces allow you to define functions that must be implemented

interface Singable{
	
	public function sing();
	
}


$animal_one = new Animal();

// These call __set

$animal_one->name = "Spot";
$animal_one->favorite_food = "Meat";
$animal_one->sound = "Ruff";

// The statements $animal_one->att_name call __get
// We call static attributes like this Class::$static_var 

echo $animal_one->name . " says " . $animal_one->sound .
	" give me some ". $animal_one->favorite_food . " my id is " .
	$animal_one->id . " total animals = " . Animal::$number_of_animals .
	"<br /><br />";
	
// If we defined a constant in the class we would get its
// value like this Class::CONTANT 
	
echo "Favorite Number " . Animal::PI . "<br />";
	
$animal_two = new Dog();

$animal_two->name = "Grover";
$animal_two->favorite_food = "Mushrooms";
$animal_two->sound = "Grrrrrrr";

// Even though we are referring to the Dog $number_of_animals it
// still increases even with subclasses

echo $animal_two->name . " says " . $animal_two->sound .
	" give me some ". $animal_two->favorite_food . " my id is " .
	$animal_two->id . " total animals = " . Dog::$number_of_animals .
	"<br /><br />";
	
// 2. Because of method overriding we get different results	
$animal_one->run();
$animal_two->run();

// 3. final methods can't be overriden
$animal_one->what_is_good();

// 4. Example using __toString()

echo $animal_two;

// 5. You call a method defined in an interface like all others

$animal_two->sing();

// 6. You can also define functions that will except classes
// extending a secific class or interface

function make_them_sing(Singable $singing_animal){
	
	$singing_animal->sing();
	
}

// 6. Polymorphism states that different classes can have different
// behaviors for the same function. The compiler is smart enough to
// just figure out which function to execute

make_them_sing($animal_one);
make_them_sing($animal_two);

echo "<br />";

function sing_animal(Animal $singing_animal){
	
	$singing_animal->sing();
	
}

sing_animal($animal_one);
sing_animal($animal_two);

// 7. Calling a static method

echo "3+5= " . Animal::add_these(3,5);

// 8. You can check the class type with instanceof

$is_it_an_animal = ($animal_two instanceof Animal) ? "True" : "False";

echo "It is " . $is_it_an_animal . ' that $animal_one is an Animal<br />';
?>
</body>
</html>