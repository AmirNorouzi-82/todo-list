<?php
function insert_task( $title, $status, $progress, $date ){

   $created_at = date('Y-m-d H:i:s');

    /**
     * Add new task to user tasks
     */
    $task   = [
        'user_id'       => get_current_user_id(),
        'title'         => db_escape($title),
        'content'       => '',
        'status'        => db_escape($status ),
        'percent'       => abs(intval($progress)),
        'due_date'      => db_escape($date),
        'created_at'    => $created_at ,
        'updated_at'    => $created_at,
        
    ];

    return db_insert('tasks', $task) ; 
      
}

function delete_task( $task_id){

    $task_id     = abs(intval($task_id));

    return db_delete(
        'tasks',
        [
            'ID' => $task_id,
            'user_id' => get_current_user_id()
        ]
        );

}

function get_task( $task_id ){
    $task_id             = abs(intval($task_id) );
    $current_user_where = 'AND user_id = '  . get_current_user();
    $sql                 = "SELECT * FROM tasks WHERE ID = $task_id  $current_user_where" ; 
    $result              = db_query($sql );
    if($result && $result-> num_rows){
       return mysqli_fetch_assoc($result); 
    }

    return false;
}

function edit_task( $task_id, $title, $status, $progress, $date ){
    
    $task_id    = intval( $task_id);
    $progress   = abs(intval($progress));
    $title      = db_escape($title);
    $status     = db_escape($status);
    $date       = db_escape($date) ;
    
    return db_update(
        'tasks' ,
        [
            'title'    => $title ,
            'status'   => $status,
            'percent'  => $progress,
            'due_date' => $date,
        ],
        [
            'ID'       => $task_id,
            'user_id'  => get_current_user_id()
        ]
        );  
}


function get_user_tasks( $limit = false ){
    $user_id = get_current_user_id();
    $sql = "SELECT * FROM tasks WHERE user_id = $user_id";
    if( $limit ){
        $sql .= "LIMIT $limit" ;   
    }

    $result = db_query( $sql );
    if($result && $result->num_rows){
        return mysqli_fetch_all($result , MYSQLI_ASSOC);
    }
    
    return false ;
    /**
     * Get User tasks
     */
    

}


function get_task_label( $status ){

    $statuses = [
        'queue'     => 'درصف',
        'doing'     => 'درحال انجام',
        'done'      => 'انجام شده',
        'expire'    => 'منقضی شده'
    ];

    return $statuses[$status];

}

function get_remain_days( $date ){
    $target = strtotime( $date );
    $remain = $target - time();
    $days   = round( $remain / 86400 );
    if( $days > 0 && $days < 5 ){
        return "$days باقیمانده";
    }
    return '';
}


function get_task_stats(){

     $stats = [
        'queue'     => 0,
        'doing'     => 0,
        'done'      => 0,
        'expire'    => 0,
    ];

    $user_id = get_current_user_id();
    $sql = " SELECT status, COUNT(*) as total FROM tasks WHERE user_id = $user_id GROUP BY status ";
    $result = db_query($sql) ;
    if(! $result || ! $result->num_rows){
        return $stats ;
    }

    $tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);

    foreach( $tasks as $task ){
        $status = $task['status'];
        $stats[$status] = $task['total'];
    }

    return $stats;

}