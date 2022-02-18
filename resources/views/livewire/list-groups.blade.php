<div class="p-8 m-8">
   <div class="font-semibold text-6xl text-center">
      <h2>List of Groups</h2>
   </div>
    <section class="bg-white py-20 lg:py-[120px]">
        <div class="container">
           <div class="flex flex-wrap -mx-4">
              <div class="w-full px-4">
                 <div class="max-w-full overflow-x-auto">
                    <table class="table-auto w-full">
                        <thead>
                            <tr class="bg-primary text-center">
                                <th>Title</th>
                                <th>Acciones</th>
                          </tr>
                       </thead>
                       <tbody class="bg-primary text-center">
                           
                           @foreach ($groups as $group)
                              <tr>
                                 <td>{{$group->title}}</td>
                                 <td>
                                    @if (!in_array($group->id,$grupJoins))
                                       <button class="p-2 bg bg-orange-400" wire:click="joinGroup({{$group->id}})">
                                          UNIRME
                                       </button>
                                    @endif
                                    <a href="{{ route('group', ['id'=>$group->id]) }}" target="_blank" rel="noopener noreferrer">IR GRUPO</a>
                                    
                                 </td>
                              </tr>
                           @endforeach

                       </tbody>
                    </table>
                   
                 </div>
              </div>
           </div>
        </div>
     </section>
</div>
