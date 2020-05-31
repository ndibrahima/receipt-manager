//DELETE USER---------------------------------------------------------------------------------------------------------------------------------->

const user = document.getElementById('user');

 if (user) {
     user.addEventListener('click', e => {
        
        if (e.target.className === 'fas fa-trash'){
          
            if (confirm('Are you sure?')) {
              const id = e.target.getAttribute('data-id'); 
              
              fetch(`/user/delete/${id}`, {
                  method: 'DELETE'}).then( res => window.location.reload());
            }
        }
     });
 }

 //DELETE INGREDIANT---------------------------------------------------------------------------------------------------------------------------------->

const ingrediant = document.getElementById('ingrediant');

if (ingrediant) {
    ingrediant.addEventListener('click', e => {
       
       if (e.target.className === 'fas fa-trash delete-ingrediant'){
         
           if (confirm('Are you sure?')) {
             const id = e.target.getAttribute('data-id'); 
             
             fetch(`/ingrediant/delete/${id}`, {
                 method: 'DELETE'}).then( res => window.location.reload());
           }
       }
    });
}

//DELETE RECEIPT---------------------------------------------------------------------------------------------------------------------------------->

const receipt = document.getElementById('receipt');

 if (receipt) {
     receipt.addEventListener('click', e => {
        
        if (e.target.className === 'fas fa-trash'){
          
            if (confirm('Are you sure?')) {
              const id = e.target.getAttribute('data-id'); 
              
              fetch(`/receipt/delete/${id}`, {
                  method: 'DELETE'}).then( res => window.location.reload());
            }
        }
     });
 }