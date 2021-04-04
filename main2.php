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
function pl($head) {
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
function is_even($n){
  if($n%2==0){
    return true;
  }return false;
}

function reverse($head) {
  // [1, 2, 8, 9, 12, 16]
  // [1, 8, 2, 9, 12, 16]
  // [1, 8, 2, 9, 16, 12]
  //   [1,2,8];
  // [2,9,12
  //]
  // [2, 18, 24, 3, 5, 7, 9, 6, 12]
  // create a new head_r for return;
  // o,o,o,o,o,   e,e,e,e,e   o,o,o,o, 
  //    ->->->       <-<-<-     ->->->
  //         pte  pee    pes
  $p_c; // current
  $p_p; // previous
  $p_n; // next
  
  $pte; // temp end
  $pee; // even ends
  $pes; // even start
  
  $head_r = new Node(9); // replicate head
  $head_r->next = $head;
  $p_p = $head_r;
  
  $p_c = $head;
  $p_n = $head->next;
  while(isset($p_c->data) && isset($p_n->data)){
     echo "position:[".$p_p->data.' '.$p_c->data.' '.$p_n->data.' '.$p_n->next->data."]\n";
    if(is_even($p_c->data) && is_even($p_n->data)){
      echo "process switch\n";
      $temp2 = $p_p;
      $temp3 = $p_c;
      $temp4 = $p_n->next;
      $p_p->next=$p_n; // prev's next to next 
        echo "connect ".$p_p->data." to ".$p_n->data.";";
      $p_c->next=$p_n->next; // 
        echo "connect ".$p_c->data." to ".$p_n->next->data.";";
      $p_n->next=$p_c; // next's next revert to current
        echo "connect ".$p_n->data." to ".$p_c->data.";\n";
      echo "After position:"; pl($head);
      $p_p = $p_n; 
      //$p_p = $temp2;
        echo "move pos ".$p_p->data." to ".$p_c->data.";";
      //$p_c = $p_n;
      //$p_c = $temp3;
        echo "move pos ".$p_p->data." to ".$p_c->data.";";
      $p_n = $temp4;
        echo "move pos ".$p_p->data." to ".$p_c->data.";";
      echo "\n\n";
    } else{
      $p_c=$p_c->next;
      $p_n=$p_n->next;
      $p_p=$p_p->next;
    }
    //pl($p_p);
   // echo $p_c->data;
  
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
