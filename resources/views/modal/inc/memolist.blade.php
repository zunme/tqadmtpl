@php
    $table_id = isset($table_id) ? $table_id : 'user_memos_'.\Str::random(4);
@endphp
<div
    x-data="{
        saveMemo(e){
            var formData = new FormData(e.target)
            axios.post(`/tqadm/api/user/${this.info.id}/memo`, formData).then(res=>{
                alertcall('메모를 남겼습니다.')
                window.dispatchEvent(new CustomEvent('{{$table_id}}_reload'));
                e.target.reset()
            })
        },
    }"
    >
    <form @submit.prevent="saveMemo(event)" class="mt-4">
        <div>메모</div>
        <textarea class="daisy-textarea w-full border border-gray-400 focus:border-blue-500 rounded focus:outline-0" name="memo" placeholder="남길 메모" required></textarea>
        <div class="flex justify-end my-2 px-2">
            <button class="py-1 px-3 rounded bg-red-600 text-white">메모저장</button>
        </div>      
    </form>
    <div class="">
        <div class="border-b-2 border-gray-300 py-4 mb-4 text-slate-500 font-bold px-5">메모</div>
        <template x-if="info?.id">
            <div>
                <x-tqhlp-pagination 
                    url="/tqadm/api/user/${info.id}/memos" 
                    side="4" class="" innerclass=""
                    tableid="{{$table_id}}"
                    formcall=null
                >
                    <template x-if="list.length < 1">
                        <div class="py-5 text-center text-gray-400 text-lg">저장된 메모가 없습니다.</div>
                    </template>
                    <template x-for="memo in list">
                        <div class="mb-4 pb-4 not-last-border-b border-gray-600 ">
                            <div class="flex justify-between text-gray-500 p-1">
                                <template x-if="memo.writeuser">
                                    <div class="px-2">
                                        <span x-text="memo.writeuser.email"></span>
                                        (<span x-text="memo.writeuser.name"></span>)
                                    </div>
                                </template>
                                <template x-if="!memo.writeuser">
                                    <div></div>
                                </template>
                                <div x-text="toDateTimeString(memo.created_at)"></div>
                            </div>
                            <pre x-text="memo.memo" 
                                class="border px-3 py-1 rounded w-full overflow-x-hidden whitespace-pre-wrap break-all"></pre>
                        </div>
                    </template>
                </x-tqhlp-Pagination>
            </div>
        </template>
    </div>
</div>