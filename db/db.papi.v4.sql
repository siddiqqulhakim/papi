-- Adminer 4.8.1 MySQL 8.0.23 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `papi_aspects_v4`;
CREATE TABLE `papi_aspects_v4` (
  `id` tinyint NOT NULL,
  `aspect` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `papi_aspects_v4` (`id`, `aspect`) VALUES
(1,	'Work Direction|Arah Kerja'),
(2,	'Leadership|Kepemimpinan'),
(3,	'Activity|Aktivitas Kerja'),
(4,	'Social Nature|Relasi Sosial'),
(5,	'Work Style|Gaya Kerja'),
(6,	'Temperament|Sifat Temperamen'),
(7,	'Followership|Posisi Atasan-bawahan');

DROP TABLE IF EXISTS `papi_questions_v4`;
CREATE TABLE `papi_questions_v4` (
  `id` tinyint NOT NULL,
  `question1` varchar(75) DEFAULT NULL,
  `value1` tinyint DEFAULT NULL,
  `question2` varchar(75) DEFAULT NULL,
  `value2` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `papi_questions_v4` (`id`, `question1`, `value1`, `question2`, `value2`) VALUES
(1,	'Saya seorang pekerja keras',	13,	'Saya bukan seorang pemurung',	17),
(2,	'Saya suka bekerja lebih baik dari orang lain',	20,	'Saya suka mengerjakan apa yang sedang saya kerjakan, sampai selesai',	1),
(3,	'Saya suka menunjukkan caranya melaksanakan sesuatu hal',	20,	'Saya ingin bekerja sebaik mungkin',	3),
(4,	'Saya suka berkelakar',	20,	'Saya senang mengatakan kepada orang lain, apa yang harus dilakukannya',	5),
(5,	'Saya suka menggabungkan diri dengan kelompok-kelompok',	20,	'Saya suka diperhatikan oleh kelompok-kelompok',	12),
(6,	'Saya senang bersahabat intim dengan seseorang',	20,	'Saya senang bersahabat dengan sekelompok orang',	10),
(7,	'Saya cepat berubah bila hal itu diperlukan',	20,	'Saya berusaha untuk intim dengan teman-teman',	9),
(8,	'Saya suka membalas dendam bila saya benar-benar disakiti',	20,	'Saya suka melakukan hal-hal yang baru dan berbeda',	16),
(9,	'Saya ingin atasan saya menyukai saya',	20,	'Saya suka mengatakan kepada orang lain, bila mereka salah',	18),
(10,	'Saya suka mengikuti perintah-perintah yang diberikan kepada saya',	20,	'Saya suka menyenangkan hati orang yang memimpin saya',	19),
(11,	'Saya mencoba sekuat tenaga',	14,	'Saya seorang yang tertib.',	13),
(12,	'Saya membuat orang lain melakukan apa yang saya inginkan',	14,	'Saya bukan seorang yang cepat gusar',	17),
(13,	'Saya suka mengatakan kepada kelompok, apa yang harus dilakukan',	19,	'Saya menekuni satu pekerjaan sampai selesai',	1),
(14,	'Saya ingin tampak bersemangat dan menarik',	19,	'Saya ingin menjadi sangat sukses',	3),
(15,	'Saya suka menyelaraskan diri dengan kelompok',	19,	'Saya suka membantu orang lain menentukan pendapatnya',	5),
(16,	'Saya cemas kalau orang lain tidak menyukai saya',	19,	'Saya senang kalau orang-orang memperhatikan saya',	12),
(17,	'Saya suka mencoba sesuatu yang baru',	19,	'Saya lebih suka bekerja bersama orang-orang daripada bekerja sendiri',	10),
(18,	'Kadang-kadang saya menyalahkan orang lain bila tejadi sesuatu kesalahan',	19,	'Saya cemas bila seseorang tidak menyukai saya',	9),
(19,	'Saya suka menyenangkan hati orang yang memimpin saya',	19,	'Saya suka mencoba pekerjaan-pekerjaan yang baru dan berbeda',	16),
(20,	'Saya menyukai petunjuk yang terinci untuk melakukan sesuatu pekerjaan',	19,	'Saya suka mengatakan kepada orang lain bila mengganggu saya',	18),
(21,	'Saya selalu mencoba sekuat tenaga',	15,	'Saya senang bekerja dengan sangat cermat dan hati-hati',	14),
(22,	'Saya adalah seorang pemimpin yang baik',	15,	'Saya mengorganisir tugas-tugas secara baik',	13),
(23,	'Saya mudah menjadi gusar',	15,	'Saya seorang yang lambat dalam membuat keputusan',	17),
(24,	'Saya senang mengerjakan beberapa pekerjaan pada waktu yang bersamaan',	18,	'Bila di dalam kelompok, saya lebih suka diam',	1),
(25,	'Saya senang bila diundang',	18,	'Saya ingin melakukan sesuatu lebih baik dari orang lain',	3),
(26,	'Saya suka berteman intim dengan teman-teman saya',	18,	'Saya suka memberi nasihat kepada orang lain',	5),
(27,	'Saya suka melakukan hal-hal yang baru dan berbeda',	18,	'Saya suka menceritakan keberhasilan saya dalam mengerjakan tugas',	12),
(28,	'Bila saya benar, saya suka mempertahankannya mati-matian',	18,	'Saya suka bergabung ke dalam suatu kelompok',	10),
(29,	'Saya tidak mau berbeda dengan orang lain',	18,	'Saya berusaha untuk sangat intim dengan orang-orang',	9),
(30,	'Saya suka diajari mengenai caranya mengerjakan suatu pekerjaan',	18,	'Saya mudah merasa jemu (bosan)',	16),
(31,	'Saya bekerja keras',	11,	'Saya banyak berpikir dan berencana',	15),
(32,	'Saya memimpin kelompok',	11,	'Hal-hal yang kecil (detail) menarik hati saya',	14),
(33,	'Saya cepat dan mudah mengambil keputusan',	11,	'Saya melakukan segala sesuatu secara rapih dan teratur',	13),
(34,	'Tugas-tugas saya kerjakan secara cepat',	11,	'Saya jarang marah atau sedih',	17),
(35,	'Saya ingin menjadi bagian dari kelompok',	16,	'Pada suatu waktu tertentu, saya hanya ingin mengerjakan satu tugas saja',	1),
(36,	'Saya berusaha untuk intim dengan teman-teman saya',	16,	'Saya berusaha keras untuk menjadi yang terbaik',	3),
(37,	'Saya menyukai mode baju baru dan tipe-tipe mobil baru',	16,	'Saya ingin menjadi penanggung jawab bagi orang-orang lain',	5),
(38,	'Saya suka berdebat',	16,	'Saya ingin diperhatikan',	12),
(39,	'Saya suka menyenangkan hati orang yang memimpin saya',	16,	'Saya tertarik menjadi anggota dari suatu kelompok',	10),
(40,	'Saya senang mengikuti aturan secara tertib',	16,	'Saya suka orang-orang mengenal saya benar-benar',	9),
(41,	'Saya mencoba sekuat tenaga',	8,	'Saya sangat menyenangkan',	11),
(42,	'Orang lain beranggapan bahwa saya adalah seorang pemimpin yang baik',	8,	'Saya berpikir jauh ke depan dan terinci',	15),
(43,	'Seringkali saya memanfaatkan peluang',	8,	'Saya senang memperhatikan hal-hal sampai sekecil-kecilnya',	14),
(44,	'Orang lain menganggap saya bekerja cepat',	8,	'Orang lain menganggap saya dapat melakukan penataan yang rapi dan teratur',	13),
(45,	'Saya menyukai permainan-permainan dan olahraga',	8,	'Saya sangat menyenangkan',	17),
(46,	'Saya senang bila orang-orang dapat intim dan bersahabat',	9,	'Saya selalu berusaha menyelesaikan apa yang telah saya mulai',	1),
(47,	'Saya suka bereksperimen dan mencoba sesuatu yang baru',	9,	'Saya suka mengerjakan pekerjaan-pekerjaan yang sulit dengan baik',	3),
(48,	'Saya senang diperlakukan secara adil',	9,	'Saya senang mengajari orang lain bagaimana caranya mengerjakan sesuatu',	5),
(49,	'Saya suka mengerjakan apa yang diharapkan dari saya',	9,	'Saya suka menarik perhatian',	12),
(50,	'Saya suka petunjuk-petunjuk terinci dalam melakukan sesuatu pekerjaan',	9,	'Saya senang berada bersama dengan orang-orang lain',	10),
(51,	'Saya selalu berusaha mengerjakan tugas secara sempurna',	7,	'Orang lain menganggap, saya tidak mengenal lelah, dalam kerja sehari-hari',	8),
(52,	'Saya tergolong tipe pemimpin',	7,	'Saya mudah berteman',	11),
(53,	'Saya memanfaatkan peluang-peluang',	7,	'Saya banyak berfikir',	15),
(54,	'Saya bekerja dengan kecepatan yang mantap dan cepat',	7,	'Saya senang mengerjakan hal-hal yang detail',	14),
(55,	'Saya memiliki banyak energi untuk permainan-permainan dan olahraga',	7,	'Saya menempatkan segala sesuatunya secara rapih dan teratur',	13),
(56,	'Saya bergaul baik dengan semua orang',	7,	'Saya pandai mengendalikan diri',	17),
(57,	'Saya ingin berkenalan dengan orang-orang baru dan mengerjakan hal baru',	10,	'Saya selalu ingin menyelesaikan pekerjaan yang sudah saya mulai',	1),
(58,	'Biasanya saya bersikeras mengenai apa yang saya yakini',	10,	'Biasanya saya suka bekerja keras',	3),
(59,	'Saya menyukai saran-saran dari orang-orang yang saya kagumi',	10,	'Saya senang mengatur orang lain',	5),
(60,	'Saya biarkan orang-orang lain mepengaruhi saya',	10,	'Saya suka menerima banyak perhatian',	12),
(61,	'Biasanya saya bekerja sangat keras',	6,	'Biasanya saya bekerja cepat',	7),
(62,	'Bila saya berbicara, kelompok akan mendengarkan',	6,	'Saya terampil mempergunakan alat-alat kerja',	8),
(63,	'Saya lambat membina persahabatan',	6,	'Saya lambat dalam mengambil keputusan',	11),
(64,	'Biasanya saya makan secara cepat',	6,	'Saya suka membaca',	15),
(65,	'Saya menyukai pekerjaan yang memungkinkan saya berkeliling',	6,	'Saya menyukai pekerjaan yang harus dilakukan secara teliti',	14),
(66,	'Saya berteman sebanyak mungkin',	6,	'Saya dapat menemukan hal-hal yang telah saya pindahkan',	13),
(67,	'Perencanaan saya jauh ke masa depan',	6,	'Saya selalu menyenangkan',	17),
(68,	'Saya merasa bangga akan nama baik saya',	12,	'Saya tetap menekuni satu permasalahan sampai ia terselesaikan',	1),
(69,	'Saya suka menyenangkan hati orang-orang yang saya kagumi',	12,	'Saya suka menjadi seorang yang berhasil',	3),
(70,	'Saya senang bila orang-orang lain mengambil keputusan untuk kelompok',	12,	'Saya suka mengambil keputusan untuk kelompok',	5),
(71,	'Saya selalu berusaha sangat keras',	4,	'Saya cepat dan mudah mengambil keputusan',	6),
(72,	'Biasanya kelompok saya mengerjakan hal-hal yang saya inginkan',	4,	'Biasanya saya tergesa-gesa',	7),
(73,	'Saya seringkali merasa lelah',	4,	'Saya lambat dalam mengambil keputusan',	8),
(74,	'Saya bekerja secara cepat',	4,	'Saya mudah mendapat kawan',	11),
(75,	'Biasanya saya bersemangat atau bergairah',	4,	'Sebagian besar waktu saya untuk berpikir',	15),
(76,	'Saya sangat hangat kepada orang-orang',	4,	'Saya menyukai pekerjaan yang menuntut ketepatan',	14),
(77,	'Saya banyak berpikir dan merencana',	4,	'Saya meletakkan segala sesuatu pada tempatnya',	13),
(78,	'Saya suka tugas yang perlu ditekuni sampai kepada hal sedetilnya',	4,	'Saya tidak cepat marah',	17),
(79,	'Saya senang mengikuti orang-orang yang saya kagumi',	5,	'Saya selalu menyelesaikan pekerjaan yang saya mulai',	1),
(80,	'Saya menyukai petunjuk-petunjuk yang jelas',	5,	'Saya suka bekerja keras',	3),
(81,	'Saya mengejar apa yang saya inginkan',	2,	'Saya adalah seorang pemimpin yang baik',	4),
(82,	'Saya membuat orang lain bekerja keras',	2,	'Saya adalah seorang yang gampangan (tak banyak pertimbangan)',	6),
(83,	'Saya membuat keputusan-keputusan secara cepat',	2,	'Bicara saya cepat',	7),
(84,	'Biasanya saya bekerja tergesa-gesa',	2,	'Secara teratur saya berolahraga',	8),
(85,	'Saya tidak suka bertemu dengan orang-orang',	2,	'Saya cepat lelah',	11),
(86,	'Saya mempunyai banyak sekali teman',	2,	'Banyak waktu saya untuk berfikir',	15),
(87,	'Saya suka bekerja dengan teori',	2,	'Saya suka bekerja sedetil-detilnya',	14),
(88,	'Saya suka bekerja sampai sedetil-detilnaya',	2,	'Saya suka mengorganisir pekerjaan saya',	13),
(89,	'Saya meletakkan segala sesuatu pada tempatnya',	2,	'Saya selalu menyenangkan',	17),
(90,	'Saya senang diberi petunjuk mengenai apa yang harus saya lakukan',	3,	'Saya harus menyelesaikan apa yang sudah saya mulai',	1);

DROP TABLE IF EXISTS `papi_results_v4`;
CREATE TABLE `papi_results_v4` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` tinyint DEFAULT NULL,
  `role_id` tinyint DEFAULT NULL,
  `value` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `papi_roles_v4`;
CREATE TABLE `papi_roles_v4` (
  `id` tinyint NOT NULL,
  `aspect_id` tinyint DEFAULT NULL,
  `code` char(1) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `papi_roles_v4` (`id`, `aspect_id`, `code`, `role`, `description`) VALUES
(1,	1,	'N',	'Need to finish task (N)|Kebutuhan menyelesaikan tugas secara mandiri',	'Faktor ini menunjukkan seberapa jauh dorongan dari dalam diri seseorang untuk menangani sendiri suatu tugas sampai benar-benar selesai. Faktor ini mencerminkan ketekunan, pada titik \"single mindedness\" pada ekstrim tinggi, dan kurangnya tanggung jawab untuk menyelesaikan tugas, bahkan mengabaikannya pada ekstrim yang lain.'),
(2,	1,	'G',	'Hard intense worked (G)|Peran pekerja keras',	'Faktor ini menunjukkan seberapa jauh seseorang mengidentifikasikan  dirinya dengan kerja keras.  Faktor ini menunjukkan penerimaan seseorang terhadap bekerja secara intensif dengan upaya yang sesuai, dalam pandangan seseorang yang melihat kerja sebagai sesuatu yang menarik, bahkan menyenangkan atau dalam pandangan seseorang yang lebih suka menghindari beban kerja bila hal tersebut dimungkinkan.'),
(3,	1,	'A',	'Need to achieve (A)|Kebutuhan berprestasi',	'Faktor ini menunjukkan seberapa besar daya dorong pribadi dan dalam diri seseorang, seberapa jauh keinginannya untuk mencapai sukses, dan seberapa besar ambisinya. Faktor ini mencerminkan derajat keyakinan dan komitmen dalam dirinya untuk mendapatkan hasil dan untuk mencapai tujuan kerja yang ditentukannya bagi dirinya sendiri.'),
(4,	2,	'L',	'Leadership role (L)|Peran kepemimpinan',	'Faktor ini menunjukkan seberapa jauh keyakinan diri seseorang untuk memproyeksikan dirinya dalam posisi pemimpin, seberapa jauh kenyamanan yang dirasakannya dalam sikap kepemimpinan, dan seberapa jauh  ia menerima dirinya dalam peran tersebut'),
(5,	2,	'P',	'Need to control others (P)|Kebutuhan mengatur orang lain',	'Faktor ini menunjukkan seberapa besar keinginan seseorang untuk memegang kendali/kontrol, untuk menggerakkan kekuatan dan dominasi terhadap orang lain. Faktor ini menunjukkan derajat kemauan seseorang untuk melaksanakan tanggung jawab yang timbul dari peran kepemimpinan untuk \"bekerja melalui orang lain dalam menyelesaikan tugas\".'),
(6,	2,	'I',	'Ease in decision making (I)|Peran membuat keputusan',	'Faktor ini menunjukkan seberapa besar kemampuan seseorang dalam kaitan dengan tugas untuk mengambil keputusan, menerima tanggung jawab dari keputusan yang diambilnya dan menerima konsekuensi dari keputusannya tersebut. Faktor ini juga menunjukkan derajat rasa tidak senang atau rasa tertekan bila menghadapi situasi dimana harus mengambil keputusan'),
(7,	3,	'T',	'Pace (T)|Peran sibuk',	'Faktor ini menunjukkan kecepatan dimana seseorang suka (secara mental bekerja).  Faktor ini menunjukkan kecepatan atau kesigapan mentalnya untuk bekerja, bukan dalam arti kepandaian atau inteligensinya, tetapi dalam arti kesigapannya untuk langsung bekerja (on-the go), dan kepekaannya terhadap \"urgensi\".'),
(8,	3,	'V',	'Vigorous type (V)|Peran penuh semangat',	'Faktor ini menunjukkan derajat seberapa jauh seseorang dapat dihubungkan dengan penampilan, aktivitas dan gerakan fisik. Faktor ini menunjukkan energi fisik yang dimiliki seseorang dan kemauannya untuk menunjukkan hal tersebut dalam kegiatannya.'),
(9,	4,	'O',	'Need for closeness and affection (O)|Kebutuhan kedekatan dan kasih sayang',	'Faktor ini menunjukkan kebutuhan seseorang akan keakraban, kehangatan dan hubungan perseorangan yang sesuai/cocok. Faktor ini juga menunjukkan derajat seberapa jauh arti penerimaan dan persetujuan orang lain bagi dirinya. Di lain pihak, faktor ini juga menunjukkan derajat seberapa besar seseorang merasa kurang senang atau merasa terluka akibat penolakan, isolasi atau ketidaksetujuan dari orang lain.'),
(10,	4,	'B',	'Need to belong to groups (B)|Kebutuhan diterima dalam kelompok',	'Faktor ini menunjukkan seberapa jauh kebutuhan seseorang untuk berada dalam kaitan dengan kelompok, untuk dapat diterima dan menjadi bagian dari kelompok.'),
(11,	4,	'S',	'Social extension (S)|Peran hubungan sosial',	'Faktor ini menunjukkan kemampuan seseorang dalam melakukan hubungan/interaksi dengan orang lain secara hangat atau menyenangkan. Faktor ini mencerminkan derajat keyakinan diri seseorang dalam berhubungan dengan orang lain, memahami arti jalinan sosial dan benar-benar menyukai hubungan dengan orang.'),
(12,	4,	'X',	'Need to be noticed (X)|Kebutuhan untuk diperhatikan',	'Faktor ini menunjukkan seberapa jauh keinginan seseorang untuk dikenali, untuk mencari perhatian yang dilakukan secara nyata dan terbuka. Faktor ini mencerminkn  dorongan untuk \"tampil\", menjadi \"sorotan\" dan dikenal.'),
(13,	5,	'C',	'Organized type (C)|Peran mengatur',	'Faktor ini menunjukkan tingkat seberapa jauh seseorang menempatkan  keteraturan, sistem dan prosedur pada diri sendiri dan pada lingkungan kerjanya. Faktor ini menunjukkan derajat atau tingkat pentingnya berada dalam situasi kerja yang terstruktur, terorganisasi, dan rapi serta mempunyai metode sebagai pembeda terhadap pendekatan apa adanya dari orang-orang yang cenderung \"seadanya saja\".'),
(14,	5,	'D',	'Interest in working with details (D)|Peran bekerja dengan hal-hal rinci',	'Faktor ini menyatakan kesigapan seseorang untuk menggunakan waktunya dalam mempertim-bangkan/pemikiran detail dari setiap aspek dalam suatu tugas atau pekerjaan. Faktor ini menunjukkan kesukaan seseorang terhadap hal-hal detail.'),
(15,	5,	'R',	'Theoretical type (R)|Peran orang yag teoritis',	'Faktor ini menunjukkan kesukaan seseorang terhadap pemikiran-pemikiran analitis dan konseptual, kemampuannya untuk menangani pandangan/pemikiran abstrak. Faktor ini menunjukkan cara yang lebih disukainya dalam bekerja secara mental, dan bukan petunjuk terhadap kecepatannya bereaksi secara mental atau terhadap inteligensinya.'),
(16,	6,	'Z',	'Need for change (Z)|Kebutuhan untuk berubah',	'Faktor ini menunjukkan seberapa jauh keinginan seseorang terhadap adanya variasi, stimulasi dan inovasi dalam pekerjaannya. Kondisi ekstrimnya adalah keinginan seseorang untuk berada pada lingkungannya yang rutin, aman dan dapat diperkirakan perubahannya Di lain pihak kebutuhan terhadap adanya perubahan yang terus menerus tanpa henti di lingkungan kerjanya.'),
(17,	6,	'E',	'Emotional resistant (E)|Peran mengendalikan emosi',	'Faktor ini menunjukkan seberapa jauh kemampuan seseorang untuk menahan atau melakukan kontrol terhadap keluarnya atau terekspresikannya perasaannya atau emosinya. Faktor ini menunjukkan tingkat sikap seseorang terhadap disiplin, terhadap kemampuan seseorang untuk tidak menunjukkan emosinya atau sebaliknya terhadap mereka yang bersikap sangat terbuka dalam menampilkan/memperlihatkan perasaan/emosinya '),
(18,	6,	'K',	'Need to be forceful (K)|Kebutuhan untuk Agresif',	'Faktor ini menunjukkan seberapa jauh seseorang memiliki kekuatan emosi dan sikap asertif, yaitu dorongan emosi yang kuat, bahkan yang agresi, dari dalam dirinya. Di lain pihak, faktor ini juga menunjukkan tingkat ketidaksukaan seseorang terhadap sikap/perasaan yang keras dan keinginannya untuk berada dalam keadaan yang harmonis dan tidak asertif.'),
(19,	7,	'F',	'Need to support authority (F)|Kebutuhan membantu atasan',	'Faktor ini menunjukkan seberapa jauh kekuatan dorongan dalam diri seseorang untuk dihubungkan dengan otoritas atau kekuatan pimpinan, kesesuaian dengan petunjuk atau saran, dan \"kemapanan\" dalam struktur hierarki, sebagai pembeda terhadap mereka  yang mandiri dan percaya diri.'),
(20,	7,	'W',	'Need for rules and supervision (W)|Kebutuhan mengikuti aturan dan pengawasan',	'Faktor ini menunjukkan seberapa jauh seseorang memerlukan dukungan, arahan atau tuntunan dari lingkungan kerja yang teratur/terstruktur, sebagai lawan dari situasi dimana seseorang dapat menampilkan sikapnya yang otonom, berinisiatif dan dapat mengarahkan dirinya sendiri.Ekstrimnya adalah orang terlalu tergantung pada organisasi pada satu sisi dan orang lain bersifat \"self starter\" pada sisi yang lain');

DROP TABLE IF EXISTS `papi_rules_v4`;
CREATE TABLE `papi_rules_v4` (
  `id` tinyint NOT NULL AUTO_INCREMENT,
  `role_id` tinyint DEFAULT NULL,
  `low_value` tinyint DEFAULT NULL,
  `high_value` tinyint DEFAULT NULL,
  `interprestation` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `papi_rules_v4` (`id`, `role_id`, `low_value`, `high_value`, `interprestation`) VALUES
(1,	1,	0,	2,	'menunda atau menghindari pekerjaan'),
(2,	1,	3,	4,	'berhati hati atau ragu dalam bekerja'),
(3,	1,	5,	6,	'cukup bertanggung jawab pada pekerjaan'),
(4,	1,	6,	9,	'tekun , tanggung jawab tinggi'),
(5,	2,	0,	2,	'cenderung malas'),
(6,	2,	3,	4,	'bekerja untuk kesenangan saja , bukan hasil optimal'),
(7,	2,	5,	7,	'kemauan bekerja keras tinggi'),
(8,	2,	8,	9,	'workaholic'),
(9,	3,	0,	5,	'ketidakpastian tujuan , kepuasan dalam suatu pekerjaan , tidak ada usaha lebih'),
(10,	3,	6,	9,	'tujuan jelas , kubutuhan sukses dan ambisi tinggi'),
(11,	4,	0,	4,	'cendurung tidak secara aktif menggunakan orang lain dalam bekerja'),
(12,	4,	5,	9,	'memproyeksikan dirinya sebagai pemimpin, suatu tingkat dimana ia mencoba menggunakan orang lain untuk mencapai tujuannya.'),
(13,	5,	0,	4,	'menurunnya keinginan untuk bertanggung jawab pada pekerjaan dan tindakan orang lain.'),
(14,	5,	5,	9,	'tingkat kebutuhan untuk menerima tanggung jawab orang lain, menjadi orang yang bertanggung jawab. '),
(15,	6,	0,	2,	'ragu - menolak mengambil keputusan '),
(16,	6,	3,	4,	'berhati hati membuat keputusan'),
(17,	6,	5,	7,	'berhati hati - lancar dan mudah mengambil keputusan'),
(18,	6,	8,	9,	'tidak ragu dalam mengambil keputusan'),
(19,	7,	0,	3,	'melakukan segala sesuatu menurut kemauannya sendiri '),
(20,	7,	4,	6,	'tergolong aktif secara internal dan mental'),
(21,	7,	7,	9,	'selalu sibuk'),
(22,	8,	0,	4,	'cenderung pasif '),
(23,	8,	5,	7,	'aktif secara fisik, cenderung sportif'),
(24,	8,	8,	9,	'sangat aktif, penuh semangat'),
(25,	9,	0,	2,	'tidak suka hubungan perorangan '),
(26,	9,	3,	4,	'sadar akan hubungan perorangan , tapi tidak terlalu tergantung'),
(27,	9,	5,	9,	'sangat tergantung , butuh penerimaan diri'),
(28,	10,	0,	3,	'selektif '),
(29,	10,	4,	5,	'butuh diterima, tapi tidak mudah dipengaruhi kelompok'),
(30,	10,	6,	9,	'butuh disukai dan diakui , mudah dipengaruhi'),
(31,	11,	0,	5,	'perhatian rendah terhadap hubungan social , kurang percaya pada orang lain'),
(32,	11,	6,	9,	'kepercayaan tinggu dalam hubungan social, suka interaksi social'),
(33,	12,	0,	1,	'cenderung pemalu '),
(34,	12,	2,	3,	'rendah hati, tulus'),
(35,	12,	4,	5,	'memiliki pola perilaku yang unik'),
(36,	12,	6,	9,	'membutuhkan perhatian nyata'),
(37,	13,	0,	2,	'fleksibel – tidak teratur '),
(38,	13,	3,	5,	'teratur tetapi tidak tergolong fleksibel'),
(39,	13,	6,	9,	'keteraturan tinggi cenderung kaku'),
(40,	14,	0,	3,	'menyadari kebutuhan akan kecermatan , tetapi tidak berminat bekerja detail '),
(41,	14,	4,	9,	'minat tinggi untuk bekerja secara detail'),
(42,	15,	0,	4,	'kurang perhatian , bersifat praktis '),
(43,	15,	5,	9,	'nilai nilai penalaran tergolong tinggi'),
(44,	16,	0,	2,	'tidak suka berubah '),
(45,	16,	3,	4,	'tidak suka perubahan jika dipaksakan'),
(46,	16,	5,	6,	'mudah menyesuaikan diri'),
(47,	16,	6,	7,	'membuat perubahan yang selektif , berfikir jauh ke depan'),
(48,	16,	8,	9,	'mudah gelisah , frustasi , karena segala sesuatu tidak berjalan fantastis'),
(49,	17,	0,	1,	'terbuka , cepat bereaksi , tidak normatif '),
(50,	17,	2,	3,	'terbuka'),
(51,	17,	4,	6,	'punya pendekatan emosional seimbang ,mampu mengendalikan'),
(52,	17,	7,	9,	'sangat normatif , kebutuhan pengendalian diri yang berlebihan'),
(53,	18,	0,	2,	'menghindari masalah , menolak untuk mengenali situasi sebagai masalah'),
(54,	18,	3,	4,	'suka lingkungan tanang , menghindari konflik'),
(55,	18,	5,	5,	'keras kepala'),
(56,	18,	6,	7,	'agresif berhubungan dengan kerja , dorongan semangat bersaing'),
(57,	18,	8,	9,	'agresif, cendering defensif'),
(58,	19,	6,	9,	'bersikap setia dan membantu , kemungkinan bantuannya bersifat politis'),
(59,	19,	4,	5,	'setia terhadap perusahaan'),
(60,	19,	2,	3,	'mengurus kepentingan sendiri'),
(61,	19,	0,	1,	'cenderung egois , kemungkinan bisa memberontak'),
(62,	20,	0,	3,	'berorientasi pada tujuan, mandiri'),
(63,	20,	4,	5,	'kebutuhan akan pengarahan dan harapan yang dirumuskan untuknya'),
(64,	20,	6,	9,	'meningkatnya orientasi terhadap tugas dan membutuhkan instruksi yang jelas');

DROP TABLE IF EXISTS `user_results_v4`;
CREATE TABLE `user_results_v4` (
  `id` int NOT NULL AUTO_INCREMENT,
  `test_id` int NOT NULL DEFAULT '1',
  `email` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `raw_result` text NOT NULL,
  `calc_result` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- 2021-11-02 09:27:59
