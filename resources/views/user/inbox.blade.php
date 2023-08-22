@include("user.sidenav")

<div class="p-4 sm:ml-64 " style="height: 100vh;">
   <div class="border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14  " style="height: 90%">
    
        <div class="flex bg-gray-100 h-full ">
            
            <!-- Right side div -->
            <div class="flex-1 p-4  bg-white m-2">
              <div class="flex flex-col h-full">
                
                <div class="pl-4 pt-2 pb-2 bg-white shadow-md font-bold flex items-center">
                    <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold mr-4">
                      <img src="https://imgs.search.brave.com/kau4VQcK_tDOp3lsvb_gEc1Krt8R55udIlZTkpODCzM/rs:fit:500:0:0/g:ce/aHR0cHM6Ly9pbWFn/ZXMuY3RmYXNzZXRz/Lm5ldC9ocmx0eDEy/cGw4aHEvNmJpNndL/SU01RERNNVUxUHRH/VkZjUC8xYzdmY2U2/ZGUzM2JiNjU3NTU0/OGE2NDZmZjliMDNh/YS9uYXR1cmUtcGhv/dG9ncmFwaHktcGlj/dHVyZXMuanBnP2Zp/dD1maWxsJnc9NjAw/Jmg9NDAw" alt="User Icon" class="w-6 h-6" />
                    </div>
                    <span>Admin</span>
                    <span class="hidden" id="receiverId">admin</span>

                  </div>
                  <!-- Employee/Admin Message Container -->
                <div class="flex-1 p-4 border-b border-gray-200 overflow-y-auto flex flex-col-reverse mt-auto" id="messageContainer">
                  <!-- Admin message -->
                  {{-- this container will be the lastest for admin --}}
                  <div class="flex items-start mb-2">
                    <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold mr-4">
                      JD
                    </div>
                    <div class="bg-blue-100 p-2 rounded-lg">
                      <p class="font-bold ">Admin</p>
                      <p class="max-w-lg">Employee message hghghhere...Employee message here...Employee message here...Employee message here...Employee message here...Employee message here...Employee message here...</p>
                      <p class="text-xs text-gray-400 text-right">June 23.12:34 PM</p>
                    </div>
                  </div>
          
                  <!-- employee message -->
                  {{-- this container will be latest for employee --}}
                  <div class="flex items-end justify-end mb-2">
                    <div class="bg-gray-100 p-2 rounded-lg">
                      <p class="font-bold">You (John Doe)</p>
                      <p class="max-w-lg">Employee message here...Employee message here...Employee message here...Employee message here...Employee message here...Employee message here...Employee message here...</p>
                      <p class="text-xs text-gray-400 text-right">June 23.12:34 PM</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold ml-4">
                      AD
                    </div>
                  </div>
                  
                </div>
          
                <!-- Message Input Container -->
                <div class="p-4 flex items-center space-x-4">
                    <input class="border border-gray-300 rounded-lg p-2 w-full h-10  " id="messageInput">
                    <button class="bg-blue-500 text-white py-2 px-4 rounded-md" id="sendMessageButton">Send</button>
                  </div>
                  
              </div>
            </div>
          </div>
          
    </div>
    
   </div>
</div>

<script>
    document.getElementById('sendMessageButton').addEventListener('click', function () {
      const messageInput = document.getElementById('messageInput');
      const messageText = messageInput.value;
  
      if (messageText.trim() !== '') {
        const messageContainer = document.getElementById('messageContainer');
  
        // Create the admin message element
        const adminMessageDiv = document.createElement('div');
        adminMessageDiv.classList.add('flex', 'items-end', 'justify-end', 'mb-2');
  
        const adminMessageContentDiv = document.createElement('div');
        adminMessageContentDiv.classList.add('bg-gray-100', 'p-2', 'rounded-lg');
  
        const adminMessageAuthor = document.createElement('p');
        adminMessageAuthor.classList.add('font-bold');
        adminMessageAuthor.textContent = 'You (John Doe)';
  
        const adminMessageText = document.createElement('p');
        adminMessageText.classList.add('max-w-lg');
        adminMessageText.textContent = messageText;

        const adminIcon = document.createElement('div');
        adminIcon.classList.add('w-10', 'h-10', 'rounded-full', 'bg-blue-500', 'flex', 'items-center', 'justify-center', 'text-white', 'font-bold', 'ml-4');
        adminIcon.textContent = 'AD';
  
        adminMessageContentDiv.appendChild(adminMessageAuthor);
        adminMessageContentDiv.appendChild(adminMessageText);
  
        adminMessageDiv.appendChild(adminMessageContentDiv);
        adminMessageDiv.appendChild(adminIcon);
  
        // Add the admin message at the bottom of the message container
        messageContainer.prepend(adminMessageDiv);
  
        // Clear the input field
        messageInput.value = '';

        //receiver Id
        const receiverId = document.getElementById('receiverId').textContent;

        //send to database
        
        const customHeaders = {
            'X-CSRF-TOKEN' : '{{ csrf_token() }}'
        };
        $.ajax({
          type:"POST",
          url:'/ajax-endpoint',
          headers:customHeaders,
          data:{
                senderId:"johndoe",
                receiverId:"Admin",
                message:messageText,
                 
          },
          cache:false,
          success:function(data){
            // console.log(`${data.message}`)
          },
          error:function(){

          }
        });
      }
    });
  </script>

  
<script>
  function getMessage(){
    const receiverId = document.getElementById('receiverId').textContent;
    const customHeaders = {
        'X-CSRF-TOKEN' : '{{ csrf_token() }}'
    };
    $.ajax({
      type:"POST",
      url:'/ajax-endpoint',
      headers:customHeaders,
      data:{
        // senderId:"Admin",
        // receiverId:receiverId
        username:"DS",
        name:"Dibesh Shah",
        message:"hello from the other world"
      },
      cache:false,
      success:function(data){

        const messages = Array.isArray(data) ? data : [data];
        // Append the new user divs based on the search results
        $.each(messages, function(index, message) {
          const userDiv = createUserMessageDiv(message);
          $('#messageContainer').prepend(userDiv);
        });
      },
      error:function(){

      }
    });
  }

  function createUserMessageDiv(user) {
    // Create the user div element
    const userDiv = $('<div class="flex items-start mb-2"></div>');

    // Create the user image div
    const userImageDiv = $(`<div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold mr-4">${user.username}</div>`);

    // Create the user message div
    const userMessageDiv = $('<div class="bg-blue-100 p-2 rounded-lg"></div>');
    const userName = $(`<p class="font-bold ">${user.name}</p>`);
    const userMessage = $(`<p class="max-w-lg">${user.message}</p>`);

    // Append the user image and details div to the user div
    userMessageDiv.append(userName);
    userMessageDiv.append(userMessage);
    userDiv.append(userImageDiv);
    userDiv.append(userMessageDiv);

    return userDiv;
  }



  setInterval(getMessage, 5000);
</script>
  
  

@include('user.footer')


