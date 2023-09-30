@extends('layouts.app')
@section('content')

<div class="p-4 sm:ml-64 " style="height: 100vh;">
    <div class="border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14  " style="height: 90%">

         <div class="flex bg-gray-100 h-full ">
             <!-- Left side div -->

             <div class="flex flex-col w-1/4 p-4  bg-white m-2" >
                 <div class="p-2  bg-white shadow-md  font-bold ">Chat</div>
                 <div class="p-2 bg-white  font-bold">
                   <div class="relative">
                     <input type="text" placeholder="Search" id ="search_user" class="border border-gray-300 rounded-lg p-2 w-full pl-10 " />
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 absolute  text-gray-400 left-3 top-3">
                       <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                     </svg>

                     <div id="searchContainer">

                     </div>
                   </div>
                 </div>
                 <div class="overflow-y-auto" id="userContainer">

                     <!-- Employee 1 -->
                     @php
                       $i = 1;
                     @endphp
                     @foreach($employees as $employee)
                      @if ($employee->role != "admin")

                      <a href="/admin/inbox/{{$employee->id}}">
                        <div class="flex items-center p-2 cursor-pointer hover:bg-gray-200">
                            <div class="w-10 h-10 rounded-full 
                            @php
                              if ($i % 2 == 0) {
                                echo "bg-blue-500 flex ";
                              }elseif ($i % 3 == 0) {
                                echo "bg-green-500 flex ";
                              }else {
                                echo "bg-purple-500 flex ";
                              }
                            @endphp
                            
                            items-center justify-center text-white font-bold mr-4">
                               {{ substr($employee->first_name, 0, 1) }}{{ substr($employee->last_name, 0, 1) }}
   
                            </div>
                            <div class="flex flex-col">
                                <span class="font-bold">{{$employee->first_name}} {{$employee->last_name}}</span>
                                <span class="text-gray-500">Recent Message</span>
                            </div>
                        </div>
                         </a>

                      @endif
                        @php
                          $i++;
                        @endphp 
                     @endforeach

                 </div>

             </div>

             <!-- Right side div -->
             @if(isset($inboxes))
             <div class="flex-1 p-4  bg-white m-2">
               <div class="flex flex-col h-full">

                 <div class="pl-4 pt-2 pb-2 bg-white shadow-md font-bold flex items-center">
                     <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold mr-4">
                       <img src="https://imgs.search.brave.com/kau4VQcK_tDOp3lsvb_gEc1Krt8R55udIlZTkpODCzM/rs:fit:500:0:0/g:ce/aHR0cHM6Ly9pbWFn/ZXMuY3RmYXNzZXRz/Lm5ldC9ocmx0eDEy/cGw4aHEvNmJpNndL/SU01RERNNVUxUHRH/VkZjUC8xYzdmY2U2/ZGUzM2JiNjU3NTU0/OGE2NDZmZjliMDNh/YS9uYXR1cmUtcGhv/dG9ncmFwaHktcGlj/dHVyZXMuanBnP2Zp/dD1maWxsJnc9NjAw/Jmg9NDAw" alt="User Icon" class="w-6 h-6" />
                     </div>
                     <span>{{$emp->first_name}} {{$emp->last_name}}</span>
                     <span class="hidden" id="receiverId">{{$emp->id}}</span>

                   </div>

                   <!-- Employee/Admin Message Container -->
                 <div class="flex-1 p-4 border-b border-gray-200 overflow-y-auto flex flex-col-reverse mt-auto" id="messageContainer">
                   <!-- Employee message -->
                   {{-- this container will be the lastest for employee --}}

                   @php
                    $length = count($inboxes);
                    $val = 1;
                  @endphp
                   @foreach($inboxes as $inbox)
                     @if ($inbox->senderId == $inbox->conversationId)
                      <div class="flex items-start mb-2">

                        <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold mr-4">
                            {{ substr($emp->first_name, 0, 1) }}{{ substr($emp->last_name, 0, 1) }}
                        </div>

                        <div class="bg-blue-100 p-2 rounded-lg">
                          <p class="font-bold ">{{$emp->first_name}} {{$emp->last_name}}</p>
                          <p class="max-w-lg">{{$inbox->message}}</p>
                          <p class="text-xs text-gray-400 text-right"> {{$inbox->dateTime}}</p>
                          @if ($val == 1)
                            <p class="hidden " id="lastId">{{ $inbox->id }}</p>
                          @endif
                        </div>
                      </div>

                      @else
                        <!-- Admin message -->
                        <div class="flex items-end justify-end mb-2">
                          <div class="bg-gray-100 p-2 rounded-lg">
                          <p class="font-bold">You (Admin)</p>
                          <p class="max-w-lg">{{$inbox->message}}</p>
                          <p class="text-xs text-gray-400 text-right"> {{$inbox->dateTime}}</p>
                          @if ($val == 1)
                            <p class=" hidden" id="lastId">{{ $inbox->id }}</p>
                          @endif
                          </div>
                          <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold ml-4">
                          AD
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
                     <input class="border border-gray-300 rounded-lg p-2 w-full h-10  " id="messageInput">
                     <button class="bg-blue-500 text-white py-2 px-4 rounded-md" id="sendMessageButton">Send</button>
                   </div>

               </div>
             </div>
             @endif
           </div>

     </div>

    </div>
 </div>


 @if(isset($inboxes))
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
         adminMessageAuthor.textContent = 'You (Admin)';

         const adminMessageText = document.createElement('p');
         adminMessageText.classList.add('max-w-lg');
         adminMessageText.textContent = messageText;

         const adminIcon = document.createElement('div');
         adminIcon.classList.add('w-10', 'h-10', 'rounded-full', 'bg-blue-500', 'flex', 'items-center', 'justify-center', 'text-white', 'font-bold', 'ml-4');
         adminIcon.textContent = 'AD';

         const time = document.createElement('p');
        time.classList.add('text-xs','text-gray-400','text-right');


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
           url:'/admin/inbox',
           headers:customHeaders,
           data:{
                
                 receiverId:receiverId,
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
             // console.log(`${data.message}`)
           },
           error:function(err){
            console.log(err)
           }
         });
       }
     });
   </script>
@endif
   <script>
     $('#search_user').on( "keyup", function() {
       var search_value = $('#search_user').val();

       if(search_value === ""){
         $('#searchContainer').hide();
         $('#userContainer').show();
       }else{
         $('#userContainer').hide();
         $('#searchContainer').show();
         const customHeaders = {
             'X-CSRF-TOKEN' : '{{ csrf_token() }}'
         };
         $.ajax({
             type:"POST",
             url:'/admin/inbox/search',
             headers:customHeaders,
             data:{
                 search:search_value
                 
             },
             cache:false,
             success:function(data){
               const users = Array.isArray(data) ? data : [data];
               // // Clear the previous user divs
               $('#searchContainer').empty();

               // // Append the new user divs based on the search results
               $.each(users, function(index, user) {
                 const userDiv = createUserDiv(user);
                 $('#searchContainer').append(userDiv);
               });
             },
             error:function(err){
              console.log(err)
             }
         });

         function createUserDiv(user) {
           // Create the user div element
           const ahref = $(`<a href="/admin/inbox/${user.id}"></a>`)
           const userDiv = $('<div class="flex items-center p-2 cursor-pointer hover:bg-gray-200"></div>');
           
           var first = user.first_name.charAt(0);
            var second = user.last_name.charAt(0);
           // Create the user image div
           const userImageDiv = $(`<div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold mr-4">${first}${second}</div>`);

           // Create the user details div
           const userDetailsDiv = $('<div class="flex flex-col"></div>');
           const userName = $(`<span class="font-bold">${user.first_name} ${user.last_name}</span>`);

           // Append the user image and details div to the user div
           userDetailsDiv.append(userName);
           userDiv.append(userImageDiv);
           userDiv.append(userDetailsDiv);
           ahref.append(userDiv);

           return ahref;
         }
       }

     });
   </script>
 @if(isset($inboxes))
 <script>
   function getMessage(){
    var lastId = document.getElementById('lastId').textContent;
     const receiverId = document.getElementById('receiverId').textContent;
     const customHeaders = {
         'X-CSRF-TOKEN' : '{{ csrf_token() }}'
     };
     $.ajax({
       type:"POST",
       url:'/admin/inbox/employeeMssgFetch',
       headers:customHeaders,
       data:{
         senderId:receiverId,
         lastId:lastId
         
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

    var senderId = `${user.senderId}`;
    var conversationId = `${user.conversationId}`;

    if(senderId === conversationId){
      // Create the user div element
     const userDiv = $('<div class="flex items-start mb-2"></div>');

      // Create the user image div
      const userImageDiv = $(`<div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold mr-4">{{ substr($emp->first_name, 0, 1) }}{{ substr($emp->last_name, 0, 1) }}</div>`);

      // Create the user message div
      const userMessageDiv = $('<div class="bg-blue-100 p-2 rounded-lg"></div>');
      const userName = $(`<p class="font-bold ">{{$emp->first_name}} {{$emp->last_name}}</p>`);
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
@endif

@endsection


