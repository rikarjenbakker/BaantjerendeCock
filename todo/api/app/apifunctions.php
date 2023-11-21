<?php

@include_once('Database.php');
header('Access-Control-Allow-Origin: http://127.0.0.1:5500');

//get all the todo's 

function jsonResponse($data)
{
  header('Content-Type: application/json');
  echo json_encode($data);
}

function getAllTodos()
{
  $sql = "SELECT * FROM `todos` ORDER BY `done_date` DESC";
  Database::query($sql);
  $todos = Database::getAll();
  
  jsonResponse($todos);
}

function addTodo(string $todo)
{
    Database::query('INSERT INTO `todos` (user_id, content) VALUES (1, :task)', ['task' => $todo]);
    Database::getAll();

    Database::query('SELECT id FROM `todos` ORDER BY `id` DESC LIMIT 1');
    $rows = Database::get();

    header('Content-Type: application/json');

    return json_encode($rows);
}

function toggleTodo(int $id)
{
    Database::query('SELECT * FROM `todos` WHERE `todos`.`id` = ?', [$id]);
    $todo = Database::get();

    $done = (int) $todo['done'] ? 0 : 1;
    Database::query('UPDATE `todos` SET `done`= :completed WHERE `id` = :id', [ ':completed' => $done, 'id' => $id ]);

    Database::query('SELECT * FROM `todos`');
    $rows = Database::getAll();
    header('Content-Type: application/json');

    return json_encode($rows);
}


// function addTodo()
// {
//     // Assuming your form sends data to /todo/api with a POST request

//     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//         // Check if any data is present in the request
//         if (!empty($_POST) || !empty($_FILES)) {
//             // Assuming you're using FormData on the client side
//             $userId = isset($_POST['user_id']) ? $_POST['user_id'] : null;
//             $content = isset($_POST['content']) ? $_POST['content'] : null;

//             // Check if required keys are set
//             if ($userId !== null && $content !== null) {
//                 // Your logic to handle the data (e.g., save it to a database)
//                 $stmt = $dbConnection->prepare("INSERT INTO todos (user_id, content) VALUES (?, ?)");
//                 $stmt->bind_param("is", $userId, $content);

//                 if ($stmt->execute()) {
//                     // Success
//                     $response = array('status' => 'success', 'message' => 'Todo added successfully');
//                 } else {
//                     // Error
//                     $response = array('status' => 'error', 'message' => 'Error adding todo');
//                 }

//                 $stmt->close();
//                 $dbConnection->close();

//                 // Sending a JSON response
//                 header('Content-Type: application/json');
//                 // echo json_encode($response);
//                 return;
//             } else {
//                 $response = array('status' => 'error', 'message' => 'Missing required parameters');
//                 http_response_code(400); // Bad Request
//             }
//         } else {
//             $response = array('status' => 'error', 'message' => 'No data sent');
//             http_response_code(400); // Bad Request
//         }
//     } else {
//         $response = array('status' => 'error', 'message' => 'Method not allowed');
//         http_response_code(405); // Method Not Allowed
//     }

//     // Sending a JSON response for errors
//     header('Content-Type: application/json');
//     // echo json_encode($response);

//     if (!empty($response)) {
//       // Sending a JSON response
//       header('Content-Type: application/json');
//       echo json_encode($response);
//       return;
//   } else {
//       // Handle other cases or return an error response
//       $response = ['status' => 'error', 'message' => 'Unexpected error'];
//       header('Content-Type: application/json');
//       echo json_encode($response);
//       return;
//   }
// }






// function addTodo()
// {
//   header('Content-Type: application/json');

//   // $apiEndpoint = "http://localhost/todo/api";
//   file_put_contents('debug.txt', file_get_contents("php://input"));

// // Check if the request method is POST
//   if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
//       // Retrieve data from the POST request
//       $postData = json_decode(file_get_contents("php://input"), true);
  
//       // Check if the data is not empty
//       if (!empty($postData)) {
//           // Process the data as needed
//           // For example, you can insert it into a database
//           // or perform other business logic
      
//           $stmt = $dbConnection->prepare("INSERT INTO todo's (user_id, content) VALUES (?, ?)");
//           $stmt->bind_param("is", $user_id, $content);
          
//           if ($stmt->execute()) {
//               // Success
//               $response = array('status' => 'success', 'message' => 'Todo added successfully');
//               echo json_encode($response);
//           } else {
//               // Error
//               $response = array('status' => 'error', 'message' => 'Error adding todo');
//               echo json_encode($response);
//           }
//           $stmt->close();
//           $dbConnection->close();
        
//           // Send a response (optional)
//           http_response_code(200); // OK
//           echo json_encode(["message" => "Data received successfully"]);
//       } else {
//           // Data is empty, handle the error
//           http_response_code(400); // Bad Request
//           echo json_encode(["error" => "Invalid or empty data"]);
//       }
//   } else {
//       // Handle other request methods or show an error
//       http_response_code(405); // Method Not Allowed
//       echo json_encode(["error" => "Method not allowed"]);
//   }
// }

  // function addTodo()
// { 
//   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
//     // Assuming you're expecting 'user_id' and 'content' in the form data
//     $user_id = $_POST['user_id'] ?? null;
//     $content = $_POST['content'] ?? null;

//     // Validate input (you might want to add more robust validation)
//     if ($user_id !== null && $content !== null) {
        
//         // Perform any additional processing or validation as needed
        
//         // Example: Insert data into a database
//         // Make sure to use proper database connection and error handling

        // $stmt = $dbConnection->prepare("INSERT INTO todo's (user_id, content) VALUES (?, ?)");
        // $stmt->bind_param("is", $user_id, $content);
        
        // if ($stmt->execute()) {
        //     // Success
        //     $response = array('status' => 'success', 'message' => 'Todo added successfully');
        //     echo json_encode($response);
        // } else {
        //     // Error
        //     $response = array('status' => 'error', 'message' => 'Error adding todo');
        //     echo json_encode($response);
        // }

        // $stmt->close();
        // $dbConnection->close();
        // console.log("jo piere");
//     } else {
//         print_r('een van de variabelen zijn verkeerd');
//         // Invalid input
//         // $response = array('status' => 'error', 'message' => 'Invalid input data');
//         // echo json_encode($response);
//     }
// } else {
//     print_r('Invalid request method');
//     // $response = array('status' => 'error', 'message' => 'Invalid request method');
//     // echo json_encode($response);
// }

// header('Content-Type: application/json');

// if(isset ($response))
// {
//   echo json_encode($response);
// } else {
//   exit();
// }

// }