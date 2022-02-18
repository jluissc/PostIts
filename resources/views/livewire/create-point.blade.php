<div class="p-4">
    @if ($status)
        <div x-data="data()">
            <button class="bg-blue-500 text-white rounded-md px-4 py-2 
            hover:bg-blue-700 transition" 
            {{-- onclick="openModal('modal')" --}} @click="isDialogOpen = true">Crear Point
        </button>
            {{-- <div  class="bg-white-300 dark:bg-fondcoment w-full rounded-full py-3 px-5 text-left dark:text-txtpost text-lg cursor-text">Postea tus dudas o sugerencias con la comunidad...</div> --}}
        
            <div class="overflow-auto " style="background-color: rgba(0,0,0,0.5)" x-show="isDialogOpen" :class="{ 'absolute inset-0 z-10 flex items-start justify-center': isDialogOpen }">
                <div class="dark:bg-gray-500   modal   bg-white-900  rounded-lg shadow-2xl  sm:m-8" x-show="isDialogOpen"
                    @click.away="isDialogOpen = false">
                    <div class="flex justify-between items-center border-0 p-2 px-5 text-xl">
                        <h6 class="text-md font-serif dark:text-white-500 text-gray-800 mx-0 ">Crear Post</h6>
                        <button type="button " @click="isDialogOpen = false" class="dark:text-white-500 text-gray-500">✖</button>
                    </div>                    
                    <div class="p-2 dark:bg-blackwhover">
                        <!-- Aqui empieza el modal -->
                        <div class="overflow-x-hidden overflow-y-auto dark:bg-gray-500 bg-white-700" style="overflow:hidden">                            
                            <div class="flex flex-wrap dark:bg-blackwhover">
                                <div class="w-full h-100">
                                    <div class="relative h-100 dvcsm" >                                            
                                        <div wire:ignore>
                                            <input type="text" name="" id="" wire:model.defer="title">
                                            <textarea id="textPost" class="px-3 w-full h-40 dark:bg-blackwhover border-0 focus:outline-none  h-100  bg-white-100 rounded-md 
                                                font-base tracking-tight text-gray-800 dark:text-whitetext text-left"   
                                                placeholder="postea tus dudas en la comunidad" wire:model.defer="description"> 
                                            </textarea>
                                        </div>     
                                        @if ($img)                                            
                                            <div class="text-center">
                                                <img src="{{$img->temporaryURL()}}" alt="" width="200px">  
                                            </div>
                                        @endif

                                        <div class="flex">
                                            <div class="p-1 flex justify-start text-left">
                                                <button type="submit" class=" bg-bluefacebook text-white-500
                                                     text-white font-serif py-1 px-5 rounded-full mr-3 outline-none"  wire:click="savePoint" x-on:click="cerrar">
                                                    Publicar
                                                </button>
                                            </div>
                                            <div class="w-64 -px-2 -mx-4 ">
                                                <div class="flex items-center h-full">                                                    
                                                    <div class="">
                                                        <svg class="text-center text-blue dark:text-whitetext  h-7 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                                        </svg>
                                                    </div>
                                                    <div class="cursor-pointer">
                                                        <label class="custom-file-upload cursor-pointer">
                                                            <input type="file" wire:model="img" title="" style="display:none">
                                                            <svg class="text-center text-blue dark:text-whitetext  h-7 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                                </path>
                                                            </svg>
                                                        </label>
                                                    </div>                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                
                                </div>
                            </div>
                        </div> 
                        <!-- Aqui empieza el modal -->
                    </div>
                </div>
            </div>
        </div>
    @else        
        <button class="p-2 bg bg-orange-400" wire:click="join()">
            UNIRME 
        </button>
    @endif
    <div class="grid lg:grid-cols-6 md:grid-cols-4 gap-4 p-8">
        @foreach ($postits as $post)
        <div class="rounded overflow-hidden shadow-sm bg bg-yellow-600">
            @if ($post->img)
                <div class="b">
                    <img class="w-full" src="{{asset('img/point/'.$post->img)}}" alt="Sunset in the mountains">
                </div>
            @endif
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">{{$post->title}}</div>
                <p class="text-gray-700 text-base">
                    {{$post->description}}
                </p>
            </div>
            @if ($status)
                @livewire('post-like',['id_post'=>$post->id], key($post->id))
            @else
            <div> 
                <button onclick="alertify.error('First join group');">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " fill="none" viewBox="0 0 24 24" stroke="currentColor" >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                      </svg>
                </button>
            </div>
            @endif
        </div>
        @endforeach
    </div>
    
    
    <script>
       function data(){
            return {
                isDialogOpen :false,
                cerrar(){
                    this.isDialogOpen = false
                },
            }
        }

        function openModal(modalId) {
            modal = document.getElementById(modalId)
            modal.classList.remove('hidden')
        }
        
        function closeModal() {
            modal = document.getElementById('modal')
            modal.classList.add('hidden')
        }
    </script>
    </div>
