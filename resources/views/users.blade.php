<x-tqadm-layout>
    @once
        @push('scripts')
            <script src="/js/jsonview.js"></script>
        @endpush
    @endonce
    <x-tqhlp-pagination 
        url="/api/admin/users" 
        side="4" class="" innerclass=""
        tableid="users"
        formcall=null
    >
        <x-slot name="script">
            openUser(user){
                window.dispatchEvent(new CustomEvent('userinfo_open', {detail:{'id' : user.id}}));
            },
        </x-slot>
        <x-slot name="form"></x-slot>

        <x-tqhlp-table role="table" >
            <x-slot name="thead">
                <tr>
                    <x-tqhlp-table role="th">#</x-tqhlp-table>
                    <x-tqhlp-table role="th">아이디</x-tqhlp-table>
                    <x-tqhlp-table role="th">이름</x-tqhlp-table>
                </tr>
            </x-slot>
            <x-slot name="tbody">
                <template x-for="item in list">
                    <tr>
                        <x-tqhlp-table role="td" x-text="item.id"></x-tqhlp-table>
                        <x-tqhlp-table role="td" x-text="item.userid" 
                            class="cursor-pointer text-blue-600 text-left"
                            @click="openUser(item)"
                            ></x-tqhlp-table>
                        <x-tqhlp-table role="td" x-text="item.name"></x-tqhlp-table>
                    </tr>
                </template>
            </x-slot>
        </x-tqhlp-table>
        <template x-if="list.length < 1">
            <div class="py-8 text-center text-gray-400 text-lg">
                데이터가 없습니다.
            </div>
        </template>
    </x-tqhlp-Pagination>

    <x-tqhlp-alpine-pop 
        modal_id="userinfo"
        closable="true"
        maxwidth="max-w-lg"
        popindex="'z-100"
        title="유저정보"
        >
        <x-slot name="datainit">
            datainit(){
                axios.get(`/api/admin/user/${this.id}`).then( res=>{
                    this.info = res.data
                    this.memos = res.data.memos
                    this.showModal()
                    //const tree = jsonview.create(res.data);
                    //jsonview.render(tree, this.$refs.userinfo);
                    const tree = jsonview.renderJSON(res.data, this.$refs.userinfo);
                })
            },
        </x-slot>
        <div x-ref="userinfo">
            
        </div>
    </x-tqhlp-alpine-pop>

</x-tqadm-layout>