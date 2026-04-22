public function up(): void
{
    Schema::create('kamars', function (Blueprint $table) {
        $table->id();
        $table->string('nomor_kamar'); // Contoh: A1, B2
        $table->string('tipe');        // Contoh: VIP, Ekonomi
        $table->integer('harga');      // Contoh: 1000000
        $table->timestamps();          // Otomatis mencatat waktu buat/edit
    });
}