<?php

namespace Database\Seeders;

use App\Models\RefPenyakit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenyakitSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $penyakit = [
            "batuk", "flu", "demam", "absans", "abses gigi", "abses peritonsil", "abses telinga", "acne vulgaris", "acquired imunodeficiency syndrome",
            "acute coronary syndrome", "adenoiditis", "alergi", "alzheimer disease", "amyloidosis", "abses anal", "aneurisma aorta",
            "angina pectoris", "angiodema", "anoreksia nervosa", "aritmia", "arthritis rheumatoid", "asam urat", "asma bronkhiale",
            "atresia ani", "autisme", "baby blues", "batu empedu", "batu ginjal", "batu kandung kemih", "batu saluran kemih", "batu rejan",
            "breastmilk jaundice", "bells palsy", "bubo inguinalis", "benjolan kelopak mata", "breastfeed jaundice", "bronkitis",
            "bulimia nervosa", "cacar air", "cacar ular", "efusi pleura", "campak", "carpal tunnel syndrome", "cedera lutut", "crohn disease",
            "crushing syndrome", "cutaneous larva migrans", "radang kelenjar air mata", "radang saluran air mata", "beri-beri", "dehidrasi",
            "demam berdarah", "demam kuning", "demam reumatik", "demam tifoid", "depresi", "dexamtefamine", "dexbrompheniramine", "dexetimide",
            "diabetes gestasional", "diabetes tipe 1", "diabetes tipe 2", "diacerein", "diare", "diaxozide", "dibekacin", "dibenzepin",
            "dicycloverine", "didanosine", "dienestrol", "dienogest", "diethylamine salicylate", "diethylstilbestrol", "difemerine",
            "difteri", "disentri amuba", "disfungsi ereksi", "eksem", "kaki gajah", "encok", "entomophobia", "epilepsi", "fibrilasi ventrikel",
            "tumor jinak payudara", "fistula ani", "flu burung", "flu singapura", "patah tulang dasar tengkorak", "patah tulang leher",
            "patah tulang lengan atas", "fraktur penis", "gagal ginjal akut", "gagal ginjal kronik", "gagal jantung", "gangguan aliran darah vena",
            "gangguan dismorfik tubuh", "gangguan hormon tiroid", "gangguan kecemasan", "gangguan menstruasi", "gangguan pergerakan lambung",
            "gangguan saraf perifer kaki", "gangguan saraf perifer tangan", "gangguan usus besar kronis", "gangren pedis", "gizi buruk tipe marasmus", "gondongan",
            "tumor pembuluh darah", "hepatitis", "hernia", "hernia lateralis", "hernia skrotalis", "hernia umbikalis", "herpes kelamin", "herpes mulut",
            "herpes telinga", "hidronefrosis", "hidrosefalus", "hipertensi", "hipertensi urgensi", "hiperteroid", "hipokondriasis",
            "hordeolum", "ileus", "imun trombositopenia purpura", "infeksi alat kelamin", "infeksi cacing", "infeksi cacing kremi", "infeksi cacing tambang",
            "infeksi cyptomegalovirus", "mononukleosis", "leptospirosis", "infeksi kulit", "giardiasis", "infeksi saluran kemih", "infeksi saluran nafas",
            "infeksi tali pusat", "infeksi telinga", "infeksi uretra", "infertilitas", "inflamasi jaringan otak", "inkontinensia usus", "jamur kepala",
            "jamur kuku", "jamur lipat paha", "radang sendi", "kandidiasis mulut", "kanker darah", "kanker hati", "kanker nasofaring", "kanker ovarium",
            "kanker paru", "kanker payudara", "kanker prostat", "kanker serviks", "kanker usus besar", "kanker tiroid", "katarak", "inkontinensia urine",
            "keguguran", "keguguran berulang", "kehamilan ektopik", "kejang demam", "kejang demam kompleks", "kejang demam sederhana",
            "kelainan anatomi usus", "epispadia", "cerebral palsy", "hirschsprung disease", "hemofilia", "kelainan katup jantung", "hipospadia",
            "endometriosis", "entropion", "ektropion", "rhinitis medikamentosa", "kencing nanah", "avoidant personality disorder", "keputihan", "keratitis",
            "kerion", "alopecia areata", "guillain barre syndrome", "kista dinding vagina", "klaustophobia", "batu saluran empedu", "kolera",
            "radang saluran empedu", "konjungtivitis", "kudis", "kutil kelamin", "kutu rambut", "infeksi telinga dalam", "intoleransi laktosa", "laringitis",
            "ablasio retina", "cracked nipple", "leprae", "limfoma", "lipoma", "ulkus kornea", "lupus eritematosus sistemik", "malaria", "mallory weiss syndrome",
            "masokisme", "radang jaringan payudara", "metroragia", "miastenia gravis", "migrain", "radang gendang telinga", "mola hidatidosa",
            "hiperemesis gravidarum", "neuralgia post herpetik", "neuralgia trigeminalis", "neuroma akustik", "nodul tiroid", "nyeri kepala kluster",
            "nyeri panggul kronis", "nyeri tulang", "nyeri otot", "oligomenorrhea", "osteoarthritis", "oitis externa sirkumskripta", "otosklerosis",
            "pankreatitis", "panu", "patah lengan bawah", "patah tulang paha", "patah tungkai bawah", "varises", "hidrokel testis",
            "benign prostatic hyperplasia", "refluks", "multiple sclerosis", "gangguan metabolik", "tetralogy of fallot", "graves desease",
            "neurodermatitis", "parkinson", "membran hialin", "paru obstruktif kronis", "buerger disease", "raynauds disease", "tarsal tunnel syndrome",
            "glaukoma", "striktur uretra", "pielonefritis", "achilles tendinitis", "henoch schonlein purpura", "hifema", "pendarahan subkonjungtiva",
            "perimenopause", "periperal neuropathy", "phlebitis", "pica", "pikun", "pilek", "pinguekula", "plasenta previa", "pleuritis",
            "pneumokoniosis", "pneumonia", "polimenorea", "poliomielitis", "polip hidung", "polycystic ovary syndrome", "pre-menstrual syndrome",
            "presbiakusis", "presbiopia", "proktitis", "pterigium", "vertigo", "inverted nipple", "hipermetropia", "miopia", "folikulitis",
            "gingivitis", "radang kantung sendi", "radang kelenjar limfe", "radang lambung", "radang prostat", "epididimitis", "bronkiolitis",
            "viral meningitis", "faringitis", "ulcerative colitis", "reumatoid artritis", "rhinitis non-alergi", "robek jaringan ginjal",
            "ruam popok", "sariawan", "maag", "scalp psoriasis", "sembelit", "heat stroke", "panick attack", "sifilis", "sifilis sekunder",
            "silindris", "sindrom tulang servikal", "sinusitis wajah", "sirosis hepatis", "solusio plasenta", "somatisasi", "somnambulisme",
            "infeksi tulang belakang", "status epileptikus", "stenosis pylorus", "stroke", "subdural hematom", "torsio testis", "kriptorkidismus",
            "hipersomnia", "tonsilitis difteri", "tortikolis", "transient ischemic attack", "trikiasis", "trikotilomania", "tuberkulosis paru",
            "tuli konduktif", "tuli sensorineural", "angiofibroma", "tumor ginjal", "tumor parotis", "ulkus duodenum", "ulkus peptikum", "hematuria",
            "urtikaria", "aspendisitis", "volvulus", "vaginal discharge", "vaginismus", "vaginitis", "vaginosis bakteri",
            "varikokel", "voyeurisme", "wasir", "xanthelasma"
        ];

        foreach ($penyakit as $item) {
            RefPenyakit::firstOrCreate([
                "nama" => $item,
            ]);
        }
    }
}
