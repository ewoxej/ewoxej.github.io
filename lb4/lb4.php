<body>
<?php
$array1 = array (1, 3, 5, 1, 8, 10, 15, 6);
$array2 = array (12, 11, 10, 12, 7, 3, 1, 6);

function count_duplicates( $arg_1, $arg_2 )
{
    $merged_array = array_merge( $arg_1, $arg_2 );
	$values_count = array_count_values( $merged_array );
	$counter = 0;
	foreach ( $values_count as $value )
	{
		if( $value > 1 ) $counter++;
	}
    return $counter;
}

function reverse_array( $arr )
{
	$counter = count( $arr );
	$new = array();
	foreach ( $arr as $key => $value )
	{
	    $counter--;
	    $new[$key] = $arr[$counter];
	}
	return $new;
}

$task1 = array_unique($array1);
$task2 = count_duplicates($array1,$array2);
$task3 = array_unique(array_merge($array1,$array2));
$task4 = reverse_array($array2);
echo "Source array 1: ";
print_r($array1);
echo "<br>Source array 2: ";
print_r($array2);
echo "<br>Task 1: ";
print_r ($task1);
echo "<br>Task 2: ";
print_r ($task2);
echo "<br>Task 3: ";
print_r ($task3);
echo "<br>Task 4: ";
print_r ($task4);
?>
</body>