<?php

// Add any extra import statements you may need here


class Node {
  public $data;
  public $next;
  function __construct($x) {
    $this->data = $x;
    $this->next = null;
  }
}

// Add any helper functions you may need here
function printLinkedLists($head) {
  $i=0;
  echo "[";
  while ($head != null && $i<20) {
    $i++;
    echo $head -> data;
    $head = $head -> next;
    if ($head != null) {
      echo " ";
    }
  }
  echo "]\n";
}

function reverse($head) {
  // [1, 2, 8, 9, 12, 16]
  // [2, 18, 24, 3, 5, 7, 9, 6, 12]
  // create a new head_r for return;
  
  $p_temp_s; // temp array start;
  $p_temp_m; // temp array mid;
  $p_temp_e; // temp array end;
  
  $head_r = new Node(9);
  $head_r->next = $head;
  $p_current = $head_r;
  
  $p_next = $head_r;
  while(isset($p_next->data)){
    if($p_next->data%2==1 && $p_next->next->data %2 ==0){
      // start of an even
      $p_temp_e = new Node($p_next->next->data); //echo "51:".$p_next->next->data.";";
      $p_temp_m = $p_temp_e;
      $p_next = $p_next->next; // move next
    }else if($p_next->data%2==0 && (!isset($p_next->next) || $p_next->next->data %2 ==1)){
      $p_current->next = $p_temp_m;
      $p_temp_e->next=$p_next->next;// connect 2 to 9
      $p_current=$p_temp_e;
      $p_next = $p_next->next; // move next
      $p_current = $p_current->next;

    }else if($p_next->data%2==0 && $p_next->next->data%2==0){ 
      // save the even number to outside link
      $p_temp = new Node($p_next->next->data);//echo "64:".$p_next->next->data."--";
      $p_temp->next = $p_temp_m;
      $p_temp_m = $p_temp;
      $p_next = $p_next->next;
    }else if($p_next->data%2==1 && $p_next->next->data%2==1){
      // odd number
      $p_current=$p_current->next;
      $p_next = $p_next->next; // move next
    }else{
      echo "should not be here;";
    }
  }
  return $head_r->next;
}










 
// These are the tests we use to determine if the solution is correct.
// You can add your own at the bottom, but they are otherwise not editable!

function printLinkedList($head) {
  echo "[";
  while ($head != null) {
    echo $head -> data;
    $head = $head -> next;
    if ($head != null) {
      echo " ";
    }
  }
  echo "]";
}

$test_case_number = 1;

function check($expectedHead, $outputHead) {
  global $test_case_number;
  $result = true;
  $tempExpectedHead = $expectedHead;
  $tempOutputHead = $outputHead;
  while ($expectedHead != null && $outputHead != null) {
    $result &= ($expectedHead -> data == $outputHead -> data);
    $expectedHead = $expectedHead -> next;
    $outputHead = $outputHead -> next;
  }
  if (!($expectedHead == null && $outputHead == null)) $result = false;

  $rightTick = '\u2713';
  $wrongTick = '\u2717';
  if ($result) {
    echo json_decode('"'.$rightTick.'"');
    echo " Test #".$test_case_number ;
    echo "\n";
  } else {
    echo json_decode('"'.$wrongTick.'"');
    echo " Test #".$test_case_number. ": Expected ";
    printLinkedList($tempExpectedHead);
    echo " Your Output : ";
    printLinkedList($tempOutputHead);
    echo "\n";
  }
  $test_case_number += 1;
}
function createLinkedList($arr) {
  $head = null;
  $tempHead = $head;
  foreach ($arr as $v) {
    if ($head == null) {
      $head = new Node($v);
      $tempHead = $head;
    } else {
      $head -> next = new Node($v);
      $head = $head -> next;
    }
  }
  return $tempHead;
}

$head_1 = createLinkedList([1, 2, 8, 9, 12, 16]);
$expected_1 = createLinkedList([1, 8, 2, 9, 16, 12]);
$output_1 = reverse($head_1);
check($expected_1, $output_1);

$head_2 = createLinkedList([2, 18, 24, 3, 5, 7, 9, 6, 12]);
$expected_2 = createLinkedList([24, 18, 2, 3, 5, 7, 9, 12, 6]);
$output_2 = reverse($head_2);
check($expected_2, $output_2);

// Add your own test cases here

   
?>
