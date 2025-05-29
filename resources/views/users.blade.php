<x-tqadm-layout>
    @once
        @push('scripts')
            <script src="/js/jsonview.js"></script>
        @endpush
    @endonce
    <x-tqhlp-pagination 
        url="/tqadm/api/users" 
        side="4" class="" innerclass=""
        tableid="users"
        formcall=null
    >
        <x-slot name="script">
            openUser(user){
                window.dispatchEvent(new CustomEvent('userinfo_open', {detail:{'id' : user.id}}));
            },
            openMemo(user){
                window.dispatchEvent(new CustomEvent('memolist_modal_open', {detail:{'id' : user.id}}));
            },
            openPoint(user){
                window.dispatchEvent(new CustomEvent('user_point_modal_open', {detail:{'id' : user.id ,'user':user}}));
            },
            
        </x-slot>
        <x-slot name="form"></x-slot>

        <x-tqhlp-table role="table" >
            <x-slot name="thead">
                <tr>
                    <x-tqhlp-table role="th">#</x-tqhlp-table>
                    <x-tqhlp-table role="th">아이디</x-tqhlp-table>
                    <x-tqhlp-table role="th">이름</x-tqhlp-table>
                    <x-tqhlp-table role="th">{{config('tqhelper.tqpoint.label','포인트')}}</x-tqhlp-table>
                    <x-tqhlp-table role="th">Cash</x-tqhlp-table>
                    <x-tqhlp-table role="th">bonus</x-tqhlp-table>
                    <x-tqhlp-table role="th">메모</x-tqhlp-table>
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
                        <x-tqhlp-table role="td" class="text-right cursor-pointer text-blue-600" x-text="(item.point).toLocaleString()" @click="openPoint(item)"></x-tqhlp-table>
                        <x-tqhlp-table role="td" class="text-right" x-text="(item.cash).toLocaleString()"></x-tqhlp-table>
                        <x-tqhlp-table role="td" class="text-right" x-text="(item.bonus).toLocaleString()"></x-tqhlp-table>
                        <x-tqhlp-table role="td" class="text-right cursor-pointer text-blue-600" x-text="item.memos_count" @click="openMemo(item)"></x-tqhlp-table>
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

<!-- pop user -->
    @include('tqadmtpl::modal.userinfo')
    @include('tqadmtpl::modal.memos')
    @include('tqadmtpl::modal.point')
<!-- /pop -->
</x-tqadm-layout>