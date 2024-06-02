<!-- Modal -->
<div class="fixed z-100000 inset-0 overflow-y-auto hidden" id="userModal">
   <div class="flex items-end justify-center min-h-screen pt-4 px-2 pb-10 text-center sm:block sm:p-0">
      <div class="fixed inset-0 transition-opacity" aria-hidden="true">
         <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
      </div>

      <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

      <div
         class="inline-block align-bottom bg-beige rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-4 sm:align-middle sm:max-w-md sm:w-full">
         <div class="bg-gray-800 px-2 pt-3 pb-2 sm:p-4 sm:pb-3">
            <div class="sm:flex sm:items-start">

               <div class="mt-2 text-center sm:mt-0 sm:ml-2 sm:text-left">
                  <h3 class="text-lg mb-2 leading-5 font-medium text-white" id="userModalTitle"></h3>
                  <div class="mt-1">
                     <form id="userForm">
                        @csrf
                        <input type="hidden" id="userId">
                        <div class="mb-2">
                           <label for="name" class="block text-xs font-medium text-gray-300">Nama</label>
                           <input type="text" name="name" id="name"
                              class="mt-1 block w-full bg-gray-900 border-gray-700 text-white rounded-md shadow-sm"
                              required>
                        </div>
                        <div class="mb-2">
                           <label for="email" class="block text-xs font-medium text-gray-300">Email</label>
                           <input type="email" name="email" id="email"
                              class="mt-1 block w-full bg-gray-900 border-gray-700 text-white rounded-md shadow-sm"
                              required>
                        </div>
                        <div class="mb-2">
                           <label for="userrole" class="block text-xs font-medium text-gray-300">Role</label>
                           <input type="text" name="userrole" id="userrole"
                              class="mt-1 block w-full bg-gray-900 border-gray-700 text-white rounded-md shadow-sm"
                              required>
                        </div>
                        <div class="mb-2">
                           <label for="password" class="block text-xs font-medium text-gray-300">Password</label>
                           <input type="password" name="password" id="password"
                              class="mt-1 block w-full bg-gray-900 border-gray-700 text-white rounded-md shadow-sm"
                              required>
                        </div>
                        <div class="mb-2">
                           <label for="password_confirmation" class="block text-xs font-medium text-gray-300">Konfirmasi
                              Password</label>
                           <input type="password" name="password_confirmation" id="password_confirmation"
                              class="mt-1 block w-full bg-gray-900 border-gray-700 text-white rounded-md shadow-sm"
                              required>
                        </div>
                        <!-- Add more fields as necessary -->
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <div class="bg-gray-900 px-2 py-2 sm:px-4 sm:flex sm:flex-row-reverse">
            <button id="saveUserBtn"
               class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-2 py-1 bg-blue-600 text-sm font-medium text-white hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-2 sm:w-auto">Simpan</button>
            <button id="cancelUserBtn"
               class="mt-2 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-2 py-1 bg-gray-600 text-sm font-medium text-white hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:w-auto">Batal</button>
         </div>
      </div>
   </div>
</div>
