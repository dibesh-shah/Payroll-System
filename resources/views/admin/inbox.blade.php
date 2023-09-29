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
                     @foreach($employees as $employee)

                     <div class="flex items-center p-2 cursor-pointer hover:bg-gray-200">
                         <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold mr-4">
                            {{ substr($employee->first_name, 0, 1) }}{{ substr($employee->last_name, 0, 1) }}

                         </div>
                         <div class="flex flex-col">
                             <span class="font-bold">{{$employee->first_name}} {{$employee->last_name}}({{$employee->role}})</span>
                             <span class="text-gray-500">Recent Message</span>
                         </div>
                     </div>

                     @endforeach

                 </div>



             </div>

             <!-- Right side div -->
             <div class="flex-1 p-4  bg-white m-2">
               <div class="flex flex-col h-full">

                 <div class="pl-4 pt-2 pb-2 bg-white shadow-md font-bold flex items-center">
                     <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold mr-4">
                       <img src="https://imgs.search.brave.com/kau4VQcK_tDOp3lsvb_gEc1Krt8R55udIlZTkpODCzM/rs:fit:500:0:0/g:ce/aHR0cHM6Ly9pbWFn/ZXMuY3RmYXNzZXRz/Lm5ldC9ocmx0eDEy/cGw4aHEvNmJpNndL/SU01RERNNVUxUHRH/VkZjUC8xYzdmY2U2/ZGUzM2JiNjU3NTU0/OGE2NDZmZjliMDNh/YS9uYXR1cmUtcGhv/dG9ncmFwaHktcGlj/dHVyZXMuanBnP2Zp/dD1maWxsJnc9NjAw/Jmg9NDAw" alt="User Icon" class="w-6 h-6" />
                     </div>
                     <span>({{$employee->first_name}} {{$employee->last_name}})</span>
                     <span class="hidden" id="receiverId">empid</span>

                   </div>
                   <!-- Employee/Admin Message Container -->
                 <div class="flex-1 p-4 border-b border-gray-200 overflow-y-auto flex flex-col-reverse mt-auto" id="messageContainer">
                   <!-- Employee message -->
                   {{-- this container will be the lastest for employee --}}
                   @foreach($inboxes as $inbox)
                   <div class="flex items-start mb-2">

                     <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold mr-4">
                        {{ substr($employee->first_name, 0, 1) }}{{ substr($employee->last_name, 0, 1) }}
                     </div>

                     <div class="bg-blue-100 p-2 rounded-lg">
                       <p class="font-bold ">({{$employee->first_name}} {{$employee->last_name}})</p>
                       <p class="max-w-lg">{{$inbox->message}}</p>
                       <p class="text-xs text-gray-400 text-right"> {{$inbox->dateTime}}</p>
                     </div>
                    </div>
                    @endforeach

                   <!-- Admin message -->
                   <div class="flex items-end justify-end mb-2">
                     <div class="bg-gray-100 p-2 rounded-lg">
                       <p class="font-bold">You (Admin)</p>
                       <p class="max-w-lg">{{$inbox->message}}</p>
                       <p class="text-xs text-gray-400 text-right"> {{$inbox->dateTime}}</p>

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
                //  senderId:'2',
                 receiverId:{{$employee->id}},
                 message:messageText,

           },
           cache:false,
           success:function(data){
            time.textContent = data;
            adminMessageContentDiv.appendChild(adminMessageAuthor);
            adminMessageContentDiv.appendChild(adminMessageText);
            adminMessageContentDiv.appendChild(time);

            adminMessageDiv.appendChild(adminMessageContentDiv);
            adminMessageDiv.appendChild(adminIcon);
            messageContainer.prepend(adminMessageDiv);
             // console.log(`${data.message}`)
           },
           error:function(){

           }
         });
       }
     });
   </script>

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
             url:'/ajax-endpoint',
             headers:customHeaders,
             data:{
                 // search:search_value
                 username:"DS",
                 name:"dibesh shah"
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
             error:function(){

             }
         });

         function createUserDiv(user) {
           // Create the user div element
           const userDiv = $('<div class="flex items-center p-2 cursor-pointer hover:bg-gray-200"></div>');

           // Create the user image div
           const userImageDiv = $(`<div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold mr-4">${user.username}</div>`);

           // Create the user details div
           const userDetailsDiv = $('<div class="flex flex-col"></div>');
           const userName = $(`<span class="font-bold">${user.name}</span>`);

           // Append the user image and details div to the user div
           userDetailsDiv.append(userName);
           userDiv.append(userImageDiv);
           userDiv.append(userDetailsDiv);

           return userDiv;
         }
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



   // setInterval(getMessage, 5000);
 </script>


@endsection


