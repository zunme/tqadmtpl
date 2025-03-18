    # usage 
        ```
        Route::get('/', function () {
            return view('tqadmtpl::sample');
        })->name('home');
        ```
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
    # migration
    php artisan vendor:publish --tag=tqadmtpl-migrations
    