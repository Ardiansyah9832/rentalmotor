<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body{
             text-align:center;
        }
    </style>
    <title>Rental Motor</title>
</head>
<body>
    <form action="" method="POST">
        <h1>Rental Motor</h1>
        <div>
            <label for="nama">Nama Pelanggan : </label>
            <input type="text" class=".form-control-sm" name="nama" id="nama" placeholder="Masukkan Nama Anda" include>
        </div>
        <div>
            <label for="lamarental">Lama waktu rental(per hari) : </label>
            <input type="number" name="lamarental" id="lamarental" placeholder="Batas minimal 1 hari" include>
        </div>
        <div>
            <label for="jenis">Jenis Motor : </label>
            <select class="form-control" name="jenis" id="jenis">
                <option value="Scooter">Scooter</option>
                <option value="Sport">Sport</option>
                <option value="SportTouring">SportTouring</option>
                <option value="Cross">Cross</option>
            </select>
        </div>
        <button type="submit" name="submit">Submit</button>    
    </form>
        <?php
        $proses = new Rental();
        $proses->setHarga(70000, 90000, 90000, 100000);
        if(isset($_POST['submit'])) {
            $proses->member = $_POST['nama'];
            $proses->jenis = $_POST['jenis'];
            $proses->waktu = $_POST['lamarental'];
            $proses->Pembayaran();
        }
        

class Data {
   public $member;
   public $jenis;
   public $waktu;
   public $diskon;
   protected $pajak;
   private $Scooter, $Sport, $SportTouring, $Cross;
   private $listMember = ['Ardi', 'Fajar', 'Fachril', 'Banyu'];

   function __construct() {
       $this->pajak = 10000;
   }

   public function getMember(){
       if (in_array($this->member, $this->listMember)){
           return "Member";
       }else{
           return "Non Member";
       }
   }

   public function setHarga($jenis1, $jenis2, $jenis3, $jenis4){
       $this->Scooter = $jenis1;
       $this->Sport = $jenis2;
       $this->SportTouring = $jenis3;
       $this->Cross = $jenis4;
   }

   public function getHarga(){
       $data['Scooter'] = $this->Scooter;
       $data['Sport'] = $this->Sport;
       $data['SportTouring'] = $this->SportTouring;
       $data['Cross'] = $this->Cross;
       return $data;
   }
}

class Rental extends Data {
   public function hargaRental(){
       $dataHarga = $this->getHarga()[$this->jenis];
       $diskon = $this->getMember() == "Member" ? 5 : 0;
       if ($this->waktu === 1){
           $bayar = ($dataharga - ($dataharga * $diskon / 100)) + $this->pajak;
       }else {
           $bayar = (($dataHarga * $this->waktu) - ($dataHarga * $diskon / 100)) + $this->pajak;
       }
       return[$bayar, $diskon];
    }

   public function Pembayaran(){
       echo "<center>";
       echo $this->member . " berstatus sebagai " . $this->getMember() . " mendapatkan diskon sebesar " . $this->hargaRental()[1] . "%";
       echo "<br />";
       echo "jenis motor yang dirental adalah " . $this->jenis . " selama " . $this->waktu . " hari ";
       echo "<br />";
       echo "harga rental per harinya : Rp. " . number_format($this-> getHarga()[$this->jenis], 0, '', ',');
       echo "<br />";
       echo "harga pajaknya seharga Rp.10.000";
       echo "<br />";
       echo "Besar yang harus dibayarkan adalah  Rp. " . number_format($this->hargaRental()[0], 0, ' ', '.');
       echo "</center>";
   }
}
 ?>
</body>
</html>