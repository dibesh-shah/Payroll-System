@extends('layouts.master')
@section('content')



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
                  
                  @php
                    $length = count($inboxes);
                    $val = 1;
                  @endphp

                  @foreach($inboxes as $inbox)
                    @if ($inbox->senderId == $inbox->conversationId)
                    <div class="flex items-end justify-end mb-2">
                      <div class="bg-gray-100 p-2 rounded-lg">
                        <p class="font-bold">You ({{$employee->first_name}} {{$employee->last_name}})</p>
                        <p class="max-w-lg">{{$inbox->message}}</p>
                        <p class="text-xs text-gray-400 text-right"> {{$inbox->dateTime}}</p>
                        @if ($val == 1)
                          <p class="hidden " id="lastId">{{ $inbox->id }}</p>
                      @endif
                      
                      </div>
                      <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold ml-4">
                          {{ substr($employee->first_name, 0, 1) }}{{ substr($employee->last_name, 0, 1) }}
                      </div>
                    </div>

                    @else

                    <div class="flex items-start mb-2">
                      <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold mr-4">
                        AD
                      </div>
                      <div class="bg-blue-100 p-2 rounded-lg">
                        <p class="font-bold ">Admin</p>
                        <p class="max-w-lg">{{$inbox->message}}</p>
                        <p class="text-xs text-gray-400 text-right">{{$inbox->dateTime}}</p>
                        @if ($val == 1)
                          <p class="hidden " id="lastId">{{ $inbox->id }}</p>
                      @endif
                      </div>
                    </div>
                    
                    @endif
                    @php
                      $val++;
                    @endphp
                  @endforeach

                </div>

                <!-- Message Input Container -->
                <div class="p-4 flex items-center space-x-4">
                    <input class="border-zinc-800 border-2 rounded-lg p-2 w-full h-10  " id="messageInput">
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
        adminMessageAuthor.textContent = 'You ({{$employee->first_name}} {{$employee->last_name}})';

        const adminMessageText = document.createElement('p');
        adminMessageText.classList.add('max-w-lg');
        adminMessageText.textContent = messageText;

        const time = document.createElement('p');
        time.classList.add('text-xs','text-gray-400','text-right');
        // adminMessageText.textContent = messageText;


        const adminIcon = document.createElement('div');
        adminIcon.classList.add('w-10', 'h-10', 'rounded-full', 'bg-blue-500', 'flex', 'items-center', 'justify-center', 'text-white', 'font-bold', 'ml-4');
        adminIcon.textContent = '{{ substr($employee->first_name, 0, 1) }}{{ substr($employee->last_name, 0, 1) }}';



        // Add the admin message at the bottom of the message container


        // Clear the input field
        messageInput.value = '';

        //send to database

        const customHeaders = {
            'X-CSRF-TOKEN' : '{{ csrf_token() }}'
        };
        $.ajax({
          type:"POST",
          url:'/employee/inbox',
          headers:customHeaders,
          data:{
                senderId:{{$employee->id}},
                message:messageText,

          },
          cache:false,
          success:function(data){
           
            var inputString = data; 
            var parts = inputString.split("&");
            time.textContent = parts[0];
            document.getElementById('lastId').textContent = parts[1];

            adminMessageContentDiv.appendChild(adminMessageAuthor);
            adminMessageContentDiv.appendChild(adminMessageText);
            adminMessageContentDiv.appendChild(time);

            adminMessageDiv.appendChild(adminMessageContentDiv);
            adminMessageDiv.appendChild(adminIcon);
            messageContainer.prepend(adminMessageDiv);
          },
          error:function(err){
            console.log(err)
          }
        });

      }
    });
  </script>


<script>
  function getMessage(){
    var lastId = document.getElementById('lastId').textContent;
    const customHeaders = {
        'X-CSRF-TOKEN' : '{{ csrf_token() }}'
    };
    $.ajax({
      type:"POST",
      url:'/employee/inbox/adminMssgFetch',
      headers:customHeaders,
      data:{

        lastId:lastId,
        senderId:{{$employee->id}}

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

    //assigning last id 
    document.getElementById('lastId').textContent = `${user.id}`;

    var receiverId = `${user.receiverId}`;
    var conversationId = `${user.conversationId}`;

    if(receiverId === conversationId){
      // Create the user div element
      const userDiv = $('<div class="flex items-start mb-2"></div>');

      // Create the user image div
      const userImageDiv = $(`<div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold mr-4">AD</div>`);

      // Create the user message div
      const userMessageDiv = $('<div class="bg-blue-100 p-2 rounded-lg"></div>');
      const userName = $(`<p class="font-bold ">Admin</p>`);
      const userMessage = $(`<p class="max-w-lg">${user.message}</p>`);
      const time = $(`<p class="text-xs text-gray-400 text-right">${user.dateTime}</p>`);

      // Append the user image and details div to the user div
      userMessageDiv.append(userName);
      userMessageDiv.append(userMessage);
      userMessageDiv.append(time);
      userDiv.append(userImageDiv);
      userDiv.append(userMessageDiv);

      return userDiv;
    }
    
  }



  setInterval(getMessage, 5000);
</script>
@endsection



