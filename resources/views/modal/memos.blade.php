    <x-tqhlp-alpine-pop 
        modal_id="memolist_modal"
        closable="true"
        maxwidth="max-w-lg"
        popindex="'z-101"
        title="유저 메모"
        >
        <x-slot name="datainit">
            datainit(){
                this.info = {id : this.id}
                this.showModal()
            },
        </x-slot>
        <template x-if="info">
            <!-- 메모 -->
            @include('tqadmtpl::modal.inc.memolist', ['table_id'=>'user_memos_modal'])
            <!-- / 메모 -->
        </template>
    </x-tqhlp-alpine-pop>