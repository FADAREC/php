public function up()
   {
       Schema::create('posts', function (Blueprint $table) {
           $table->id();
           $table->unsignedBigInteger('user_id');
           $table->string('title');
           $table->text('body');
           $table->timestamps();

           $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
       });
   }