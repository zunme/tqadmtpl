    # 같이 설치되는것들
        - ROLE & PERMISSION 템플릿 같이 설치됨
        - forms 
    # migration && config
        - admtpl
        ```
        php artisan vendor:publish --tag=tqadmtpl-migrations
        php artisan vendor:publish --tag=tqadmtpl-configs
        ```

        - forms
        ```
        php artisan vendor:publish --tag="tqforms-migrations"
        php artisan vendor:publish --tag="tqforms-config"
        php artisan vendor:publish --tag="tqforms-views"
        php artisan vendor:publish --tag="tqforms-assets"
        ```

    # 어드민 기본 템플릿 
        ```
        Route::get('/', function () {
            return view('tqadmtpl::sample');
        })->name('home');
        ```
    # memo MORPH 테이블
        ```
        // ** add model 
        public function memos()
        {
            return $this->morphMany(Taq\Tqadmtpl\Models\TqMemo::class, 'tqmemotag');
        }
        ```
        - insert memo
            model->memos()->create([...])
                OR
            $tqmemo = ...
            model->memos()->attach( $tqmemo )
        - remove memo
            delete single
            model->memos()->detach( $memoId)
                or 
            delete all
            model->memos()->detach();
        - 참고 https://laravel.com/docs/12.x/eloquent-relationships

    # 텔레그램에 메시지보내기
        use Taq\Tqadmtpl\Classes\TqTelegramMsg;

        $t = (new TqTelegramMsg)->sendTelegram('test')
        $t = (new TqTelegramMsg)->set( TOKEN, CHATID )->sendTelegram('test')


    # 텔레그램 토큰 구하기
        Telegram Web-version(https://web.telegram.org) 으로 접속 후 botfather 를 검색
        @BotFather 를 선택하면 START 를 눌러 대화를 시작

        아래 순서대로 입력
        /newbot
        봇이름
        unique 봇username_bot
        - 토큰구하기
            API 토큰 을 구한후
                config telegram.bot_token 에 저장
        - chat id 구하기
            1.
            t.me/[username] 을 클릭하여 채팅
            https://api.telegram.org/bot[토큰]/getUpdates
            내용안 "from":{"id" : XXXXXX } 를 
                config telegram.chat_id 에 저장
            2. php artisan tinker
                use Taq\Messages\Messages
                (new Messages)->getme() 로 chat_id 구해서
                config telegram.chat_id 에 저장

    ## TQFOMS
        # Usage
            -addscript
                @taqScripts

            - filepond
            <x-tq-filepond-ext-multi name="images1" max_file_size="10MB" maxFiles="10" required multiple external_box_view></x-tq-filepond-ext-multi>

            -현재 사용안함
            ```php
            $tqforms = new Taq\Tqforms();
            echo $tqforms->echoPhrase('Hello, Taq!');
            ```
        # Trait
            Taq\Tqforms\Traits\TqformTrait
            $this->moveTo( filename , 'images');
            $this-copyTo( filename , 'images');
            
        # Command
            - tqforms:clear
                -- tmp 디렉토리내 파일 (24시간이 지난) 삭제
        # Testing

        ```bash
        composer test
        ```
        # workday 계산
            use Taq\Tqforms\Classes\WorkdayCalculator
            $c = new WorkdayCalculator('2025-01-25',2)->calc()
            ```
                [
                    "initDate" => Carbon\Carbon @1737730800 {#6226
                    date: 2025-01-25 00:00:00.0 Asia/Seoul (+09:00),
                    },
                    "initDateIsHoliday" => true,
                    "workdate" => Carbon\Carbon @1737990000 {#6227
                    date: 2025-01-28 00:00:00.0 Asia/Seoul (+09:00),
                    },
                    "consecutiveDays" => [
                    [
                        "date" => Carbon\Carbon @1738076400 {#6219
                        date: 2025-01-29 00:00:00.0 Asia/Seoul (+09:00),
                        },
                        "title" => "설날",
                    ],
                    [
                        "date" => Carbon\Carbon @1738162800 {#6220
                        date: 2025-01-30 00:00:00.0 Asia/Seoul (+09:00),
                        },
                        "title" => "설날",
                    ],
                    ],
                    "workdayIsLastOfMonth" => false,
                    "consecutiveDaysHasLastOfMonth" => false,
                    "days" => [
                    "28",
                    "29",
                    "30",
                    ],
                ]

            ```
            -- file
                Taq\Tqforms\Classes\WorkdayCalculator
                Taq\Tqforms\Models\HolidaysModel
                database/migrations/create_tq_holidays_table.php.stub

        # Changelog

        Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

        # component
        <x-tq-filepond-ext-multi name="images1" max_file_size="10MB" maxFiles="10" multiple external_box_view></x-tq-filepond-ext-multi>
        <x-tq-flatpickr name="date" value="{{now()->addDay(15)->toDateString()}}" option="['format'=>'Ymd']" value="2025-02-10" class="text-black" wrap_class=""></x-tq-flatpickr>

        <x-tq-toast title_class="text-lg" content_class="text-sm" close_time="3000"></x-tq-toast>
        script : tq_toast(this.title, { description: this.description, type: this.type, position: this.position, html: html })
    