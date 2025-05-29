    @php
        $point_label = config('tqhelper.tqpoint.label','포인트');
        $point_unit = config('tqhelper.tqpoint.unit','P');
    @endphp
    <x-tqhlp-alpine-pop 
        modal_id="user_point_modal"
        closable="true"
        maxwidth="max-w-screen-lg"
        popindex="'z-102"
        title="유저 포인트 리스트"
        >
        <x-slot name="datainit">
            datainit(){
                this.info = {id : this.id}
                this.showModal()
            },
        </x-slot>
        <template x-if="info && info.id">
            <div>
                <div class="flex justify-between mb-2">
                    <div>
                        <span x-text="user.userid"></span>
                        (<span x-text="user.name"></span>)
                    </div>
                    <div>
                        <span x-text="user.point.toLocaleString()"></span> {{$point_unit}}
                    </div>
                </div>
                <x-tqhlp-pagination 
                    url="/tqadm/api/user/${info.id}/point" 
                    side="4" class="" innerclass=""
                    tableid="user_point_list"
                    formcall=null
                >
                    <template x-if="list.length < 1">
                        <div class="py-5 text-center text-gray-400 text-lg">저장된 메모가 없습니다.</div>
                    </template>
                    <template x-if="list.length > 0">
                    <x-tqhlp-table role="table" >
                        <x-slot name="thead">
                            <tr>
                                <x-tqhlp-table role="th">#</x-tqhlp-table>
                                <x-tqhlp-table role="th">구분</x-tqhlp-table>
                                <x-tqhlp-table role="th">구분상세</x-tqhlp-table>
                                <x-tqhlp-table role="th">{{$point_label}}</x-tqhlp-table>
                                <x-tqhlp-table role="th">사용</x-tqhlp-table>
                                <x-tqhlp-table role="th">만료</x-tqhlp-table>
                                <x-tqhlp-table role="th">내용</x-tqhlp-table>
                            </tr>
                        </x-slot>
                        <x-slot name="tbody">
                            <template x-for="item in list">
                                <tr>
                                    <x-tqhlp-table role="th" x-text="item.id">#</x-tqhlp-table>
                                    <x-tqhlp-table role="th" x-text="item.log_type_label">#</x-tqhlp-table>
                                    <x-tqhlp-table role="th" x-text="item.point_type_label">#</x-tqhlp-table>
                                    <x-tqhlp-table role="th" class="text-right" x-text="`${item.point.toLocaleString()} {{$point_unit}}`">#</x-tqhlp-table>
                                    <x-tqhlp-table role="th" class="text-right" x-text="`${item.point_use.toLocaleString()} {{$point_unit}}`">#</x-tqhlp-table>
                                    <x-tqhlp-table role="th" x-text="item.is_expired">#</x-tqhlp-table>
                                    <x-tqhlp-table role="th" class="text-left" x-text="item.desc">#</x-tqhlp-table>
                                </tr>
                            </template>
                        </x-slot>
                    </x-tqhlp-table>
                    </template>
                </x-tqhlp-pagination>
            </div>
        </template>
    </x-tqhlp-alpine-pop>