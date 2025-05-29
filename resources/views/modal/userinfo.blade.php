    <x-tqhlp-alpine-pop 
        modal_id="userinfo"
        closable="true"
        maxwidth="max-w-lg"
        popindex="'z-100"
        title="유저정보"
        >
        <x-slot name="datainit">
            datainit(){
                axios.get(`/tqadm/api/user/${this.id}`).then( res=>{
                    this.info = res.data
                    this.showModal()

                    //const tree = jsonview.renderJSON(res.data, this.$refs.userinfo);
                })
            },
            saveInfo(e){
                if( confirm('변경하시겠습니까?') ){
                    var formData = new FormData(e.target)
                    axios.post(`/tqadm/api/user/${this.info.id}/info`, formData).then(res=>{
                        alertcall('변경하였습니다.')
                        e.target.reset()
                    })
                }
            },
            savePwd(e){
                if( confirm('비밀번호를 변경하시겠습니까?') ){
                    var formData = new FormData(e.target)
                    axios.post(`/tqadm/api/user/${this.info.id}/pwd`, formData).then(res=>{
                        alertcall('변경하였습니다.')
                        e.target.reset()
                    })
                }
            },

            savePoint(e){
                var formData = new FormData(e.target)
                axios.post(`/tqadm/api/user/${this.info.id}/point`, formData).then(res=>{
                    alertcall('저장하였습니다.')
                    this.info.point = res.data.point
                    window.dispatchEvent(new CustomEvent('user_memos_refresh'));
                    // users_refresh
                    window.dispatchEvent(new CustomEvent('users_refresh'));
                    e.target.reset()
                })  
            },
            openPoint(){
                window.dispatchEvent(new CustomEvent('user_point_modal_open', {detail:{'id' : this.info.id ,'user':this.info}}));
            },
        </x-slot>
        <template x-if="info">
            <div>
                <form class="mb-4" @submit.prevent="saveInfo(event)">
                    <x-tqhlp-table role="table" >
                        <x-slot name="colgroup">
                            <col width="100px" />
                            <col width="*" />
                        </x-slot>
                        <x-slot name="tbody">
                            <tr>
                                <x-tqhlp-table role="th">아이디</x-tqhlp-table>
                                <x-tqhlp-table role="td" x-text="info.userid"  class="text-left"></x-tqhlp-table>
                            </tr>
                            <tr>
                                <x-tqhlp-table role="th">인증</x-tqhlp-table>
                                <x-tqhlp-table role="td" x-text="( info.checkplus_log_id ? '인증':'비인증' )" class="text-left"></x-tqhlp-table>
                            </tr>
                            <tr>
                                <x-tqhlp-table role="th">이름</x-tqhlp-table>
                                <x-tqhlp-table role="td">
                                    <input type="" name="name" :value="info.name" 
                                        class="border py-1 px-2 text-base w-full border-gray-400  focus:border-blue-500 rounded"
                                        required
                                        >
                                </x-tqhlp-table>
                            </tr>
                            <tr>
                                <x-tqhlp-table role="th">TEL</x-tqhlp-table>
                                <x-tqhlp-table role="td">
                                    <input type="" name="" :value="info.tel" 
                                        class="border py-1 px-2 text-base w-full border-gray-400  focus:border-blue-500 rounded"
                                        >
                                </x-tqhlp-table>
                            </tr>
                            <tr>
                                <x-tqhlp-table role="th">개인/법인</x-tqhlp-table>
                                <x-tqhlp-table role="td">
                                    <select
                                            class="daisy-select w-full border border-gray-400 rounded focus:outline-0 focus:border-blue-400"
                                            x-model="info.personality"
                                        >
                                        <option disabled >개인/법인 선택</option>
                                        <option value="0">개인</option>
                                        <option value="1">법인</option>
                                    </select>

                                </x-tqhlp-table>
                            </tr>
                        </x-slot>
                    </x-tqhlp-table>
                    <div class="flex justify-end my-2 px-2">
                        <button class="py-1 px-3 rounded bg-red-600 text-white">변경</button>
                    </div>
                </form>

                <form class="mb-4" @submit.prevent="savePwd(event)">
                    <x-tqhlp-table role="table" >
                        <x-slot name="colgroup">
                            <col width="100px" />
                            <col width="*" />
                        </x-slot>
                        <x-slot name="tbody">
                            <tr>
                                <x-tqhlp-table role="th">비밀번호</x-tqhlp-table>
                                <x-tqhlp-table role="td">
                                    <input type="password" name="password"
                                        class="border py-1 px-2 text-base w-full border-gray-400  focus:border-blue-500 rounded"
                                        required
                                        >
                                </x-tqhlp-table>
                            </tr>
                        </x-slot>
                    </x-tqhlp-table>
                    <div class="flex justify-end my-2 px-2">
                        <button class="py-1 px-3 rounded bg-red-600 text-white">변경</button>
                    </div>
                </form>

                <form class="mb-4" @submit.prevent="savePoint(event)">
                    <x-tqhlp-table role="table" >
                        <x-slot name="colgroup">
                            <col width="100px" />
                            <col width="*" />
                        </x-slot>
                        <x-slot name="tbody">
                            <tr>
                                <x-tqhlp-table role="th">포인트 <span @click="openPoint()">V</span></x-tqhlp-table>
                                <x-tqhlp-table role="td">
                                    <input type="text"
                                        class="border py-1 px-2 text-base w-full border-gray-400  focus:border-blue-500 rounded text-right"
                                        :value="parseInt(info.point).toLocaleString()"
                                        readonly
                                        >
                                </x-tqhlp-table>
                            </tr>
                            <tr>
                                <x-tqhlp-table role="th">추가/삭제</x-tqhlp-table>
                                <x-tqhlp-table role="td">
                                    <input type="number"
                                        name="addpoint"
                                        class="border py-1 px-2 text-base w-full border-gray-400  focus:border-blue-500 rounded text-right"
                                        required
                                        >
                                </x-tqhlp-table>
                            </tr>
                            <tr>
                                <x-tqhlp-table role="th">사유</x-tqhlp-table>
                                <x-tqhlp-table role="td">
                                    <textarea class="daisy-textarea w-full border rounded focus:outline-0 border-gray-400 focus:border-blue-500" name="memo" placeholder="남길 메모"></textarea>
                                </x-tqhlp-table>
                            </tr>
                        </x-slot>
                    </x-tqhlp-table>
                    <div class="flex justify-end my-2 px-2">
                        <button class="py-1 px-3 rounded bg-red-600 text-white">변경</button>
                    </div>
                </form>



                <!-- 메모 -->
                @include('tqadmtpl::modal.inc.memolist', ['table_id'=>'user_memos'])
                <!-- / 메모 -->

            </div>
        </template>
    </x-tqhlp-alpine-pop>