let plusButton;
let addButton;
let formattedDate;

window.onload = function() 
{
  getTodos();
  
  plusButton = document.getElementById("addButton");
  plusButton.addEventListener('click', addTodo);
  addButton = document.getElementById('addButton');
  addButton.addEventListener("click", addTodo);
}

// toggelen van de status van een todo

async function toggleDone(event)
{
  event.preventDefault();

  console.log(event.target.classList);

  if(event.target.classList.contains('la-circle')) {
    	event.target.classList.remove('la-circle');
      event.target.classList.add('la-check-circle'); 
  } else {
    event.target.classList.remove('la-check-circle');
    event.target.classList.add('la-circle');
  }

  // API Call om in de db te updaten
  updateDoneStatus(event.target.dataset.id);
}

async function updateDoneStatus(id)
{
  await fetch('http://localhost/todo/api/index.php?cmd=toggle&id=' + id)
    .then(response => response.json())
    .then(data => {
      console.log(data);
      location.reload();
    })
    .catch(error => console.log(error));
}

// tonen van de bestaande todo's uit de database

let todos;
let toggleDoneElements;

async function getTodos()
{
  await fetch('http://localhost/todo/api/index.php?cmd=all')
  .then(response => response.json())
  .then(data => {
    todos = data;
    makeTodoElementCode();
    
    
    toggleDoneElements = document.querySelectorAll('span[aria-label=toggle_done] i');
    
    toggleDoneElements.forEach(toggleDoneElement => {
      toggleDoneElement.addEventListener('click', toggleDone);
    });
  })
}

function makeTodoElementCode()
{
  todos.forEach(todo => {
    if(todo.done == 0)
    {
      todoDate(todo.done_date);

      let content = `<div class="row d-flex justify-content-center my-2">
      <div class="card mx-2 mb-2 col-8 bg-secondary text-info">
        <div class="row">
          <span style="text-decoration: none; color: #ffffff;" class="col-2 d-flex align-items-center" aria-label="toggle_done">
            <i style="font-size: 1.5rem; font-weight: 400;" class="las la-circle" data-id="${todo.id}"></i>
          </span>
          <div class="col-9 p-1">
            ${todo.content}
          </div>
        </div>
      </div>
      <div class="card mb-2 col-2 d-flex align-items-center justify-content-center bg-secondary text-info">
        <div>
          ${formattedDate}
        </div>
      </div>
    </div>`
      document.getElementById("section").insertAdjacentHTML('beforeend', content)
    } else
    {
      todoDate(todo.done_date);

      let content = `<div class="row d-flex justify-content-center my-4">
      <div class="card mx-2 mb-2 col-8 bg-secondary text-info opacity-75">
      <div class="row">
      <span style="text-decoration: none; color: #ffffff;" class="col-2 d-flex   align-items-center" aria-label="toggle_done">
      <i style="font-size: 1.5rem; font-weight: 400;" class="las la-check-circle" data-id="${todo.id}"></i>
      </span>
      <div class="col-9 p-1">
         <s>${todo.content}</s>
          </div>
        </div>
      </div>
      <div class="card mb-2 col-2 d-flex align-items-center justify-content-center bg-secondary opacity-75 text-info">
        <div>
          ${formattedDate}
        </div>
      </div>
      </div>`
      document.getElementById("done-section").insertAdjacentHTML('afterend', content)
    }
  })
}

function todoDate(date)
{
  let options = { day: 'numeric', month: 'numeric' };
  let dateParts = date.split('-');
  let year = parseInt(dateParts[0]);
  let month = parseInt(dateParts[1]) - 1;
  let day = parseInt(dateParts[2]);
  let todoDate = new Date(year, month, day);
  formattedDate = todoDate.toLocaleDateString(undefined, options);
}

// toevoegen van een nieuwe todo

function addTodo()
{
  let todoInput = document.getElementById('newToDo');
  let todo = todoInput.value;
  // let datepicker = document.getElementById('datepicker');
  // let date = new Date(datepicker.value);


  fetch(`http://localhost/todo/api/index.php?cmd=add&text=${todo}`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    }
        // body: JSON.stringify({ todo }),
  })
  location.reload();
}



// async function addTodo() {
//   try {
//     let newToDoValue = document.getElementById('newToDo').value;

//     let formData = new FormData();
//     formData.append('user_id', 1);
//     formData.append('content', newToDoValue);

//     const response = await fetch('http://localhost/todo/api/?cmd=add', {
//       method: 'POST',
//       body: formData,
//     });

//     if (!response.ok) {
//       throw new Error(`HTTP error! Status: ${response.status}`);
//     }

//     const data = await response.json();
//     console.log(data);
//     return data;
//   } catch (error) {
//     console.error('API ERROR:', error);
//   }
// }


/* <div class="row d-flex justify-content-center my-2">
      <div class="card mx-2 mb-2 col-8 bg-secondary text-info">
      <div class="row">
      <span style="text-decoration: none; color: #ffffff;" class="col-2 d-flex   align-items-center" aria-label="toggle_done">
      <i style="font-size: 1.5rem; font-weight: 400;" class="las la-circle"></i>
      </span>
      <div class="col-9 p-1">
          ${todo.content}
          </div>
        </div>
      </div>
      <div class="card mb-2 col-2 d-flex align-items-center justify-content-center bg-secondary    text-info">
        <div>
          ${todo.done_date}
        </div>
      </div>
      </div> */
