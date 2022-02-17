<div class="p-4">
    @if ($status)
        <div x-data="data()">
            <button class="bg-blue-500 text-white rounded-md px-4 py-2 
                hover:bg-blue-700 transition" 
                {{-- onclick="openModal('modal')" --}} x-on:click="mostrar('modal')">Crear Point
            </button>
        
            <div x-show="st">
                <div id="modal" class="fixed hidden z-150 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4">
                    <div class="relative top-40 mx-auto shadow-lg rounded-md bg-white max-w-md">
                 
                        <div class="flex justify-between items-center bg-green-500 text-white text-xl rounded-t-md px-4 py-2">
                            <h3>Create Point</h3>
                            <button x-on:click="ocultar('modal')">x</button>
                        </div> 
                        <div class="max-h-250 overflow-y-scroll p-4" wire:ignore>
                            <div class="mb-6">
                                @if ($img)
                                    <img src="{{$img->temporaryURL()}}" alt="" width="100px">
                                @endif
                                <input type="file" wire:model.defer="img" title="">
                            </div>
                            <form wire:submit.prevent="savePoint">                    
                                <div class="mb-6">
                                    <input 
                                    type="text" placeholder="Your Title"
                                    class=" w-full rounded py-3 px-[14px]
                                    text-body-color text-base border border-[f0f0f0]
                                    outline-none focus-visible:shadow-none
                                    focus:border-primary " wire:model.defer="title"/>
                                </div>
                                
                                <div class="mb-6">
                                   <textarea rows="2" placeholder="Your Description"
                                      class=" w-full rounded py-3 px-[14px]
                                      text-body-color text-base border border-[f0f0f0]
                                      resize-none outline-none focus-visible:shadow-none
                                      focus:border-primary " wire:model.defer="description"></textarea>
                                </div>
                                <div>
                                    <button type="submit"
                                        class=" w-full bg bg-green-500 text-black bg-primary rounded
                                        border border-primary p-3 transition hover:bg-opacity-90 " >
                                        Save Point
                                    </button>
                                </div>
                             </form>
                        </div> 
                        <div class="px-4 py-2 border-t border-t-gray-500 flex justify-end items-center space-x-4">
                            <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition" x-on:click="ocultar('modal')">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else        
        <button class="p-2 bg bg-orange-400" wire:click="join()">
            UNIRME 
        </button>
    @endif
    <div class="grid grid-cols-4 gap-4 p-8">
        @foreach ($postits as $post)
        <div class="max-w-sm rounded overflow-hidden shadow-sm">
            <img class="w-full" src="{{asset('img/'.$post->img)}}" alt="Sunset in the mountains">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">{{$post->title}}</div>
                <p class="text-gray-700 text-base">
                    {{$post->description}}
                </p>
            </div>
        </div>
        @endforeach
    </div>
    
    
    <script>
        function data(){
            return {
                st : false,
                mostrar(id){
                    this.st = true;
                    modal = document.getElementById(id);
                    modal.classList.remove('hidden');
                },
                ocultar(id){
                    this.st = false;
                    modal = document.getElementById(id);
                    modal.classList.add('hidden');
                }
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
