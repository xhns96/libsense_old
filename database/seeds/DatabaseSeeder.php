<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $a = new \App\Admin();
        $a->name = "Rustam Kurganov";
        $a->email = "admin@gmail.com";
        $a->password = \Illuminate\Support\Facades\Hash::make('123123123');
        $a->admin_iss = 'yes';
        $a->admin_profile_status = 'active';
        $a->admin_university_id = 13;
        $a->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'O\'zbekiston milliy universiteti';
        $aUniver->univer_short_name = 'O\'zMU';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Toshkent davlat texnika universiteti';
        $aUniver->univer_short_name = 'TDTU';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Toshkent davlat iqtisodiyot universiteti';
        $aUniver->univer_short_name = 'TDIU';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'O\'zbekiston davlat jahon tillari universiteti';
        $aUniver->univer_short_name = 'UZSWLU';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Toshkent davlat sharqshunoslik instituti';
        $aUniver->univer_short_name = 'TDSI';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Toshkent arxitektura-qurilish instituti';
        $aUniver->univer_short_name = 'TASI';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Toshkent to\'qimachilik va yengil sanoat istituti';
        $aUniver->univer_short_name = 'TITLI';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Toshkent avtomobil-yo\'llari instituti';
        $aUniver->univer_short_name = 'TAYI';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Toshkent moliya instituti';
        $aUniver->univer_short_name = 'TMI';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Toshkent davlat pedagogika universiteti';
        $aUniver->univer_short_name = 'TDPU';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Toshkent kimyo-texnologiya instituti';
        $aUniver->univer_short_name = 'TKTI';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Andijon davlat universiteti';
        $aUniver->univer_short_name = 'ADU';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Andijon mashinasozlik instituti';
        $aUniver->univer_short_name = 'AndMI';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Buxoro davlat universiteti';
        $aUniver->univer_short_name = 'BuxDU';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Buxoro muhandislik-texnologiya instituti';
        $aUniver->univer_short_name = 'BTI';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Guliston davlat universiteti';
        $aUniver->univer_short_name = 'GulDU';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Jizzax politexnika instituti';
        $aUniver->univer_short_name = 'JizPI';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Qoraqalpoq davlat universiteti';
        $aUniver->univer_short_name = 'KARSU';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Qarshi davlat universiteti';
        $aUniver->univer_short_name = 'QarDU';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Qarshi muhandislik-iqtisodiyot instituti';
        $aUniver->univer_short_name = 'QMII';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Namangan davlat universiteti';
        $aUniver->univer_short_name = 'NamDU';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Namangan muhandislik-pedagogika instituti';
        $aUniver->univer_short_name = 'NamMPI';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Namangan muhandislik-texnologik instituti';
        $aUniver->univer_short_name = 'NamMTI';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Samarqand davlat universiteti';
        $aUniver->univer_short_name = 'SamDU';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Samarqand davlat chet tillari instituti';
        $aUniver->univer_short_name = 'SamDCHTI';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Samarqand iqtisodiyot va servis instituti';
        $aUniver->univer_short_name = 'SIES';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Samarqand davlat arxitektura-qurilish instituti';
        $aUniver->univer_short_name = 'SAMGASI';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Termez davlat universiteti';
        $aUniver->univer_short_name = 'TerDU';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Urganch davlat universiteti';
        $aUniver->univer_short_name = 'UrDU';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Farg\'ona davlat universiteti';
        $aUniver->univer_short_name = 'FDU';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Farg\'ona politexnika insituti';
        $aUniver->univer_short_name = 'FarPI';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Jizzax davlat pedagogka instituti';
        $aUniver->univer_short_name = 'JDPI';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Qo\'qon davlat pedagogika instituti';
        $aUniver->univer_short_name = 'QDPI';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Nukus davlat pedagogika instituti';
        $aUniver->univer_short_name = 'NDPI';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Navoi davlat pedagogika instituti';
        $aUniver->univer_short_name = 'NavDPI';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Toshkent tibbiyot akademiyasi';
        $aUniver->univer_short_name = 'TTA';
        $aUniver->univer_course_count = 6;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Toshkent tibbiyot akademiyasi (Urganchdagi filiali)';
        $aUniver->univer_short_name = 'TTAUF';
        $aUniver->univer_course_count = 6;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Toshkent tibbiyot akademiyasi (Farg\'onadagi filiali)';
        $aUniver->univer_short_name = 'TTAFF';
        $aUniver->univer_course_count = 6;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Toshkent pediatriya tibbiyot instituti';
        $aUniver->univer_short_name = 'TPTI';
        $aUniver->univer_course_count = 6;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Toshkent pediatriya tibbiyot instituti (Nukusdagi filiali)';
        $aUniver->univer_short_name = 'TPTINF';
        $aUniver->univer_course_count = 6;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Toshkent farmatsevtika instituti';
        $aUniver->univer_short_name = 'TFI';
        $aUniver->univer_course_count = 6;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Toshkent davlat stomatologiya instituti';
        $aUniver->univer_short_name = 'TDSI';
        $aUniver->univer_course_count = 6;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Toshkent davlat stomatologiya instituti  (Buxoro filiali)';
        $aUniver->univer_short_name = 'TDSIBF';
        $aUniver->univer_course_count = 6;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Toshkent davlat stomatologiya instituti  (Samarqand filiali)';
        $aUniver->univer_short_name = 'TDSISF';
        $aUniver->univer_course_count = 6;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Toshkent davlat stomatologiya instituti  (Nukus filiali)';
        $aUniver->univer_short_name = 'TDSINF';
        $aUniver->univer_course_count = 6;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Toshkent davlat stomatologiya instituti  (Andijon filiali)';
        $aUniver->univer_short_name = 'TDSIAF';
        $aUniver->univer_course_count = 6;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Andijon davlat tibbiyot instituti';
        $aUniver->univer_short_name = 'ADTI';
        $aUniver->univer_course_count = 6;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Buxoro davlat tibbiyot instituti';
        $aUniver->univer_short_name = 'BDTI';
        $aUniver->univer_course_count = 6;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Samarqand davlat tibbiyot instituti';
        $aUniver->univer_short_name = 'SDTI';
        $aUniver->univer_course_count = 6;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Toshkent irrigatsiya va melioratciya instituti';
        $aUniver->univer_short_name = 'TIMI';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Toshkent irrigatsiya va melioratciya instituti (Buxorodagi filiali)';
        $aUniver->univer_short_name = 'TIMIBF';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Toshkent davlat agrar universiteti';
        $aUniver->univer_short_name = 'TDAU';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Toshkent davlat agrar universiteti (Nukusdagi filiali)';
        $aUniver->univer_short_name = 'TDAUNF';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Toshkent davlat agrar universiteti (Andijondagi filiali)';
        $aUniver->univer_short_name = 'TDAUAF';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Toshkent davlat agrar universiteti (Samarqanddagi filiali)';
        $aUniver->univer_short_name = 'TDAUSF';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Toshkent axborot texnologiyalari universiteti';
        $aUniver->univer_short_name = 'TATU';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Toshkent axborot texnologiyalari universiteti (Samarqanddagi filiali)';
        $aUniver->univer_short_name = 'TATUSF';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Toshkent axborot texnologiyalari universiteti (Qarshidagi filiali)';
        $aUniver->univer_short_name = 'TATUQF';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Toshkent axborot texnologiyalari universiteti (Urganchdagi filiali)';
        $aUniver->univer_short_name = 'TATUUF';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Toshkent axborot texnologiyalari universiteti (Nukusdagi filiali)';
        $aUniver->univer_short_name = 'TATUNF';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Toshkent axborot texnologiyalari universiteti (Farg’onadagi filiali)';
        $aUniver->univer_short_name = 'TATUFF';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Toshkent davlat o`zbek tili va adabiyoti universiteti';
        $aUniver->univer_short_name = 'ToshDO\'TAU';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Jahon iqtisodiyoti va diplomatiya universiteti';
        $aUniver->univer_short_name = 'UWED';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'O’zbekiston davlat konservatoriyasi';
        $aUniver->univer_short_name = 'O\'zDK';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'O\'zbekiston davlat san\'at va madaniyat instituti';
        $aUniver->univer_short_name = 'O\'zDSMI';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Milliy raqs va xoreografiya Oliy Maktabi';
        $aUniver->univer_short_name = 'MRXOM';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'O\'zbek davlat jismoniy tarbiya instituti';
        $aUniver->univer_short_name = 'UZDJTI';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Toshkent davlat san’at instituti (Nukusdagi filiali)';
        $aUniver->univer_short_name = 'O\'zDSMINF';
        $aUniver->univer_course_count = 4;
        $aUniver->save();

        $aUniver = new \App\University();
        $aUniver->univer_name = 'Toshkent davlat yuridik universiteti';
        $aUniver->univer_short_name = 'TDYU';
        $aUniver->univer_course_count = 4;
        $aUniver->save();


        $aUniver = new \App\University();
        $aUniver->univer_name = 'Toshkent temir yo’l transporti muhandislari instituti';
        $aUniver->univer_short_name = 'TashIIT';
        $aUniver->univer_course_count = 4;
        $aUniver->save();
    }
}
