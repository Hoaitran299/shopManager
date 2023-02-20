-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2023 at 07:26 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_02_01_092630_create_mst_users_table', 1),
(7, '2023_02_01_092716_create_mst_shop_table', 1),
(8, '2023_02_01_092734_create_mst_customer_table', 1),
(9, '2023_02_01_092657_create_mst_product_table', 2),
(10, '2023_02_14_210202_create_product_group', 3);

-- --------------------------------------------------------

--
-- Table structure for table `mst_customer`
--

CREATE TABLE `mst_customer` (
  `customer_id` int(10) UNSIGNED NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tel_num` varchar(14) NOT NULL,
  `address` varchar(255) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mst_customer`
--

INSERT INTO `mst_customer` (`customer_id`, `customer_name`, `email`, `tel_num`, `address`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Bà. Tô Quế', 'kiet.phung@domain.com', '8179600686', 'Aperiam repellendus in est doloremque in. Sapiente vel velit sint commodi. Eos sed nisi quod voluptates perspiciatis cupiditate.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(2, 'Chử Hà', 'le.hai@domain.com', '3705946934', 'Et et perspiciatis occaecati dignissimos. Quod et consequatur error tenetur illo soluta. Aut quasi aperiam hic ut accusamus laboriosam. Recusandae sit vel doloremque necessitatibus.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(3, 'Bác. Phan Sương', 'luong.doan@domain.com', '3262304344', 'Accusamus distinctio mollitia quia. Ipsum fugiat eligendi maiores dolorem perferendis rerum ratione iure. Omnis corrupti sequi voluptatibus ipsum itaque porro.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(4, 'Đinh Hoài', 'yen70@domain.com', '3325904156', 'Omnis nam itaque est omnis earum reiciendis. Nisi omnis sint velit eius. Nostrum perspiciatis sed dolor. Unde ratione eum voluptate accusamus beatae. Maiores ipsum qui quasi est doloribus.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(5, 'Bác. Tăng Kiệt Toàn', 'anh96@domain.com', '1953658827', 'Occaecati ea id et qui fuga. Sequi quia dolores sunt. Fugiat ut enim deleniti officia. Harum fugit dolor impedit quod ab. Voluptas voluptatem id dolorem rem.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(6, 'Khưu Thy', 'luong.hao@domain.com', '2662811924', 'Aut enim explicabo qui qui necessitatibus. Voluptatem consequatur mollitia praesentium odit laudantium quas corrupti. Aliquam ab autem blanditiis in placeat consequatur at.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(7, 'Chị. Lều Như', 'tu.liu@domain.com', '1421045231', 'Quia vel dicta dolores maiores. Non mollitia earum qui maiores. Odio non dolor in nesciunt. Qui similique illo vel dolore quam autem repellendus. Impedit animi reprehenderit expedita et.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(8, 'Tăng Nghiệp', 'cung.khanh@domain.com', '6796809218', 'Doloribus blanditiis nisi ea ut voluptate consectetur velit. Accusamus ullam rerum velit cumque sunt mollitia. Explicabo eaque non delectus distinctio delectus debitis.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(9, 'Ông. Trịnh Dinh', 'ngan.han@domain.com', '9186851869', 'Impedit voluptas dolor ut suscipit ut. Nihil laudantium eum nemo. Et expedita dolorem hic dolorum atque qui nesciunt qui.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(10, 'Nhậm Trà', 'kcat@domain.com', '4670058736', 'Et id quis sit nihil velit. Inventore nemo aspernatur quibusdam ipsum. Officiis nihil veritatis aut rerum est modi accusantium. Ipsa eaque sed quo neque. Maiores vero atque dolorum aliquam beatae.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(11, 'Chị. Yên Bạch Dương', 'why@domain.com', '8581063751', 'Rerum praesentium nulla beatae quod et fugiat quae. Est ea voluptatem adipisci sit rerum. Et omnis nesciunt architecto rerum.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(12, 'Vũ Họa Lâm', 'dau.thuan@domain.com', '8426599811', 'Ab reiciendis eveniet adipisci modi eum sapiente sed. Fuga vitae soluta maxime possimus dignissimos voluptatem et. Et aliquam omnis ut sed quibusdam fugiat dolorum.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(13, 'Bác. Tạ Đăng Trọng', 'sang40@domain.com', '6567150540', 'Ab officia et eaque maxime. Blanditiis eius at distinctio vel. Omnis facere et corrupti ut qui.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(14, 'Em. Lư Phượng Lộc', 'pdanh@domain.com', '1356080217', 'Minima vel quos molestias quis quae libero assumenda. Eos aut quos sed omnis natus voluptas nobis. Unde voluptatem fugiat voluptas quo totam autem. Accusamus ipsam voluptas nemo eaque.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(15, 'Em. Thào Thu', 'dng90@domain.com', '6942577104', 'Impedit magni aut illo. Placeat ratione blanditiis laboriosam minus rerum error nemo cupiditate. Aliquam aliquid ex quo sint ducimus et voluptatum. Voluptates eum quia delectus.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(16, 'Chú. Kha Kiên Võ', 'tho81@domain.com', '0835205618', 'Enim non quae aut amet illo quia. Quia autem labore ipsa sed aliquam sunt omnis. Ut consequuntur sequi sit nemo.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(17, 'Chú. Đôn Văn', 'phuong.ha@domain.com', '4523771928', 'Illo maiores eum nisi consequatur quia cumque illum. Aperiam ut eveniet beatae autem et sed est. Nulla quasi ex necessitatibus odit. Deserunt voluptas nihil culpa.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(18, 'Nhậm Vinh', 'vbu@domain.com', '0780189319', 'Vitae id tempore non ducimus. Voluptas tempora quidem sit dolorum. Saepe non at atque voluptatem praesentium. Ratione et id sunt qui qui quia.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(19, 'Cụ. Điền Vũ', 'trac.be@domain.com', '7531542604', 'Quod quia asperiores tempore consequatur sit distinctio sit est. Aut cupiditate saepe voluptas saepe dignissimos id.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(20, 'Bác. Thôi Dạ Ty', 'dai71@domain.com', '4423619558', 'Iste sunt temporibus et reiciendis. Vel dolorum aut dolorum ut odio qui. Soluta est vitae dignissimos atque. Ab in et quos iusto dolor et.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(21, 'Bác. Liễu Ngà', 'nluu@domain.com', '0827321942', 'Sed autem quidem reiciendis dolorem recusandae. Vero exercitationem occaecati architecto est optio. Facere quidem voluptas ut dolorem. A voluptatibus aliquam assumenda qui earum eos eos ipsam.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(22, 'Bàng Hoan', 'trng74@domain.com', '1046667159', 'Occaecati voluptas officia cumque voluptate dignissimos qui. Eum qui rerum quis nihil. Deleniti enim fuga modi occaecati libero consequatur. Aperiam vel odio enim. Maxime at dignissimos et.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(23, 'Quách Phượng Hải', 'tra.ha@domain.com', '4192874736', 'Dolor nihil officiis voluptatibus minima cupiditate. Voluptatem et rerum voluptatem iusto. Aliquid similique qui deleniti et sed pariatur eum. Dolor voluptas necessitatibus voluptatem nemo.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(24, 'Chú. Chu Công', 'nghi.phuc@domain.com', '4462800130', 'Labore maiores explicabo ab sed qui explicabo eum. Ea necessitatibus neque numquam est. Cupiditate soluta molestiae pariatur praesentium ut enim dolorem ut. Quasi est quibusdam facere et quia et.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(25, 'Ty Hoàn', 'ynghiem@domain.com', '0443741555', 'Expedita ut dicta aut asperiores. Saepe dolores ut expedita similique molestiae voluptatem aut. Quas id et rerum ea quae. Tempora sint optio est voluptatum enim praesentium qui.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(26, 'Hà Sinh', 'ly48@domain.com', '0382319461', 'Quae nisi laudantium cum at. Beatae optio debitis illum voluptatem et. Nemo ut saepe consequatur.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(27, 'Bà. Yên Cúc', 'dai.anh@domain.com', '1804063260', 'Iure eum neque numquam quo sit. Eos quia ut sit voluptatem illum et. Iusto tempore sit voluptas omnis sapiente. Quisquam maiores eos voluptatum.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(28, 'Ông. Đồng Trí', 'vi.thanh@domain.com', '6489907127', 'Corrupti in aliquam autem earum rerum molestiae quis. Debitis asperiores ipsam suscipit aspernatur inventore. Saepe quia accusamus aspernatur molestiae itaque nobis.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(29, 'Diệp Thạc', 'suong21@domain.com', '7457086430', 'Consectetur cumque id nostrum quo. Dignissimos quaerat voluptas sequi dolores dolorum. Ut velit sed sapiente cupiditate.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(30, 'Bác. Bạc Liễu Quế', 'to.nguyet@domain.com', '6043813389', 'Quis nihil quisquam ratione consectetur voluptatem quisquam ad. Libero quis impedit qui repellat atque.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(31, 'An Duy Hòa', 'nha26@domain.com', '2993608122', 'Tenetur dignissimos accusamus ut quisquam tempore. Recusandae animi autem recusandae a. Sed voluptas cupiditate atque. Est consequatur qui voluptatem aut.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(32, 'Chú. Trình Đạt Chiểu', 'nhiem.an@domain.com', '8957903137', 'Enim doloribus accusamus consequatur saepe accusantium aut ut. Voluptatibus atque aperiam voluptates.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(33, 'Cụ. Tông Khánh Khuê', 'thc30@domain.com', '8791919447', 'Officiis est voluptatem veniam eveniet cupiditate inventore eius voluptate. Fugit quia voluptatem nesciunt nihil ab ex aspernatur. Eum vero similique harum numquam voluptatem quia quo.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(34, 'Cao Khánh', 'lac.long@domain.com', '2478142464', 'A voluptatem explicabo et molestiae. Aliquam cumque omnis corrupti sunt eligendi aperiam suscipit. Laborum maiores eum quia omnis.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(35, 'Bành Hương', 'nong.nha@domain.com', '0829821479', 'Vero quae et dolores minus ea est magni. Dolore quisquam vitae recusandae inventore mollitia temporibus sunt. Aut est recusandae cupiditate perferendis. Et architecto voluptatem nisi vero labore.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(36, 'Trần Lai', 'trieu42@domain.com', '6917458941', 'Accusamus eos et et quia natus. Qui repellat consequatur sed nihil. Neque id consequatur eos. Assumenda iusto soluta dignissimos molestias animi.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(37, 'Bác. Lạc Thiện', 'epho@domain.com', '2308548876', 'Rerum odit rerum sunt aliquam. Enim magnam quas sequi quia expedita tempore. Impedit repellat exercitationem velit hic ducimus. Minus cum nisi consequatur incidunt. Corrupti qui labore nulla.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(38, 'Chị. Mâu Hiền Thoa', 'pcung@domain.com', '2759803553', 'Placeat natus esse soluta ut possimus eius. Aut consequuntur pariatur tempora repellat. Veniam aut qui nam placeat iure.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(39, 'Đan Đồng Ngọc', 'dinh.ha@domain.com', '9695177787', 'Necessitatibus laborum aut suscipit ut delectus qui vel. Aspernatur aliquid dolores nisi minus. Assumenda et quasi nulla sit neque. Ea sunt autem soluta ea laborum aut.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(40, 'Lưu Ngân Quế', 'jngan@domain.com', '8257018625', 'Quia libero distinctio natus quaerat. Et velit ullam a molestias. Voluptatibus recusandae velit nisi soluta et. Hic enim aut debitis facilis totam iste nihil officia.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(41, 'Chị. Thân Lam', 'kim.ma@domain.com', '9143566550', 'Quos asperiores non nostrum qui sunt consectetur. Ut qui quae accusamus est ex. Et explicabo porro et odio. Consequatur quasi hic hic fugiat est aut necessitatibus.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(42, 'Biện Nghi', 'dan67@domain.com', '9552208550', 'Quis accusamus quos iure rerum. Quas possimus deleniti consectetur. Rerum optio nesciunt quas dolores dolorum.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(43, 'Bà. Cung Thuần Hoa', 'hoai52@domain.com', '4001944166', 'Ducimus consequatur amet quia. Consectetur ab explicabo labore officia sint. Animi amet rerum totam nostrum laudantium quis laudantium.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(44, 'Em. An Yên Chi', 'ly38@domain.com', '3611124974', 'Non qui velit vel eligendi dolore est. Nulla ipsum sed qui ducimus dolorem aliquid quod. Laboriosam enim voluptas omnis amet quidem ipsum. Harum esse tenetur et assumenda eum alias occaecati.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(45, 'Thạch Nghĩa', 't.uong@domain.com', '8096802242', 'Nihil ipsum ab sequi et esse mollitia. Quis magnam natus accusamus. Qui suscipit culpa dolores veniam dolores inventore libero repudiandae. Aut corporis iusto rerum.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(46, 'Mang Hạnh Nhân', 'jto@domain.com', '1631300384', 'Enim aut quia debitis provident iure sit. Tempore deleniti eius reprehenderit sint reiciendis nulla voluptatibus.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(47, 'Cụ. Ma Kính', 'sinh99@domain.com', '8451660815', 'Ea voluptas rerum voluptatem veniam in id voluptatem. Enim aut qui repellendus deleniti adipisci incidunt.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(48, 'Mâu Sương', 'tvi@domain.com', '6966156558', 'Eligendi aliquid blanditiis quidem. Ipsum aut quia deleniti culpa. Sit consectetur ut adipisci quis deleniti.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(49, 'Bình Tuấn', 'diem.sang@domain.com', '2509237053', 'Officiis neque eveniet et qui et sunt. Dolor ipsum eos at consequatur laudantium. Provident ab perferendis ut sit rerum consequatur. Omnis libero minima maxime dignissimos.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(50, 'Bác. Nông Minh', 'ich@domain.com', '9521634205', 'Suscipit eum doloribus aliquid ex aspernatur quisquam quas. Esse aut nisi distinctio et culpa omnis libero. Voluptatibus sunt ipsa enim quis excepturi.', 1, '2023-02-07 07:15:13', '2023-02-07 07:15:13'),
(51, 'Giang Nhu', 'cu.anh@domain.com', '8034097056', 'Quis hic omnis voluptatibus qui harum non rerum tempore. Similique et cupiditate nemo adipisci aliquid at sunt rerum. Ad exercitationem sit porro.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(52, 'Bác. Bùi Ngôn', 'nha.ninh@domain.com', '6648439004', 'Ipsa nam consequuntur enim consequatur. Dignissimos assumenda atque ratione eius nemo. Qui omnis et non debitis est et.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(53, 'Khâu Duy Trụ', 'iha@domain.com', '9330787003', 'Eum nulla accusantium neque ut et fuga voluptatem. Dolorem soluta reiciendis fugit facilis.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(54, 'Bác. Dương Khai Hoán', 'dung.bien@domain.com', '8295699965', 'Repellat corporis commodi repellat et. Expedita inventore vero nihil ea omnis eveniet velit architecto. Dolorum itaque alias totam laudantium molestiae. Sunt quia expedita vel tempore et.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(55, 'Đoàn Huỳnh Khê', 'trieu.luu@domain.com', '9128089431', 'Quia quia consequatur velit. Magnam tempore molestiae in qui sit harum amet. Hic deserunt voluptate accusantium ipsam quo doloribus amet alias. Dolor saepe voluptatem pariatur ut et et omnis.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(56, 'Chị. Huỳnh Tú San', 'ocao@domain.com', '9652934688', 'Officia eum et necessitatibus veniam adipisci eum quisquam perspiciatis. Est minus a officiis et. Quia debitis accusamus omnis et. Et consequatur voluptate quo mollitia qui.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(57, 'Thái Phụng', 'an.tuyen@domain.com', '6443024865', 'Ducimus quis dicta et tempora quas non. Non ratione est ducimus voluptas praesentium velit. Facere eos perspiciatis architecto doloremque dolor dolore. Cumque voluptatem vel et quis.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(58, 'Châu Bảo', 'v33@domain.com', '5540083163', 'Neque nesciunt provident eveniet dolorem sit dolores explicabo. Minima laudantium alias labore quo. Et amet et aperiam ex delectus occaecati.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(59, 'Cô. Lã Trang Thu', 'utu@domain.com', '5688656664', 'Aut quasi officiis impedit cumque rem fugiat. Occaecati eos sunt et asperiores. Rerum perspiciatis ut dolorem ea maxime quo.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(60, 'Anh. Biện Dương', 'kinh08@domain.com', '5423796147', 'Possimus occaecati suscipit autem blanditiis sint possimus qui. Et consequatur maxime sed. Temporibus aut ea laborum accusamus accusamus aut. Quidem aut non nemo illo quis at.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(61, 'Bùi Trình', 'cuong.d@domain.com', '3383850588', 'Inventore aut molestias assumenda. Incidunt laborum distinctio explicabo et delectus. Ut nostrum earum qui cum eveniet doloremque.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(62, 'Chị. Đàm Thuần Lợi', 'ity@domain.com', '3077507587', 'Blanditiis itaque repellat nesciunt fuga ea odio. Ratione dolorem omnis nam delectus sequi ut facilis. Soluta illum nostrum sed.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(63, 'Chú. Xa Dương Lực', 'canh24@domain.com', '2775438637', 'Sunt quos id perspiciatis dicta ut. Qui mollitia voluptas repellendus magnam modi. Quaerat quod recusandae asperiores provident fugit et.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(64, 'Lạc Từ', 'hang25@domain.com', '4490725862', 'Accusantium eum corrupti et maiores. Distinctio ut necessitatibus et aperiam doloribus accusamus rerum. Nihil inventore consectetur dolores sit libero impedit ut. Tenetur in recusandae rem doloribus.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(65, 'Ông. Thào Như Vu', 'edao@domain.com', '8893750705', 'Et omnis doloribus at reprehenderit non est non. Iusto consectetur sed qui alias eos ad. Nobis et beatae illum aliquid eius et ut. Hic sint rerum aut omnis quasi quasi.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(66, 'Cô. Đôn Sương Lệ', 'tong.thuan@domain.com', '9598933595', 'Voluptatem ut voluptatibus veritatis aspernatur modi. Nisi ad possimus assumenda et. Animi aut sed placeat et repellendus. Recusandae consequuntur et dolores aut. Voluptatibus qui odit dolorem.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(67, 'Chị. Tòng Thắm', 'vy.ch@domain.com', '1146599111', 'Porro porro qui perferendis ipsum sunt harum rerum. Autem quibusdam debitis ut nulla itaque quam. Corporis odio debitis harum illum enim ipsum dignissimos. Ipsa quos quia aut deleniti quas a.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(68, 'Cam Oanh Cầm', 'ngo.hoang@domain.com', '8643115479', 'Repellat ut et inventore quia. Quia rerum ipsum ea. Et et et tenetur rerum ad qui. Dolorum deleniti vero pariatur ut porro quia.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(69, 'Thịnh Lệ Quế', 'hoa69@domain.com', '5455199179', 'Quo quasi nam facilis sit sed dolores. Aut omnis omnis sed nesciunt non. Molestiae aliquam et ratione voluptatibus aliquam quia. Unde praesentium impedit et velit dolores id.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(70, 'Mạc Thống', 'ung.vi@domain.com', '0156980754', 'Molestias ut non minima consequatur ipsam adipisci. Aut occaecati ad quo iure sit. Maxime velit sed et itaque omnis dignissimos fugit.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(71, 'Thi Nghị', 'viet.phi@domain.com', '2058757986', 'Qui quia at ut aut laborum aut laboriosam. Eaque similique nisi rerum aut enim saepe. Dolorem quia nihil quam enim ab delectus et. Illo architecto totam impedit ut placeat.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(72, 'Yên Bội Phúc', 'n.thai@domain.com', '6024672224', 'Et deleniti error dolor fuga ea possimus qui minus. Assumenda aut dolorem deleniti qui. Enim aut perferendis facilis. Totam facilis accusantium beatae minima occaecati amet.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(73, 'Khổng Phục Toàn', 'thuan.cat@domain.com', '9045103775', 'Quae alias et et voluptates. Esse esse molestiae quidem quaerat. Vitae asperiores ut quaerat voluptates. Sit aut doloremque amet est ut eligendi aut.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(74, 'Bửu Phụng', 'hung.hao@domain.com', '7977999626', 'Asperiores molestiae eius voluptas ratione. Odio debitis blanditiis sequi animi hic vel.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(75, 'Anh. Quản Vĩ', 'adam@domain.com', '4964074909', 'Tempore sed eum et reiciendis aliquam odit aut. Et cupiditate tempore animi enim nemo debitis. Non voluptas veritatis et ut vitae et est accusantium.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(76, 'Chị. Hà Lan', 'vi.hp@domain.com', '3206626823', 'Voluptas velit reiciendis et sed est rerum. Quisquam sapiente est sit sapiente earum id nihil. Quia officia inventore et voluptatem sed et. Asperiores praesentium ipsum eaque et.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(77, 'Bác. Mang Phúc Sỹ', 'nanh@domain.com', '9008757941', 'Sunt itaque veritatis a dolores et. Molestias excepturi voluptatem unde eum voluptates. Quia tempore accusamus culpa et a omnis doloribus. Quidem odit et qui dicta qui dignissimos.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(78, 'Chương Trà My', 'dung51@domain.com', '3385435323', 'Sit commodi atque quis molestiae qui. Ut repudiandae assumenda harum aperiam odit. Natus ipsa fugit illum officiis.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(79, 'Đổng Khang Kiếm', 'yen08@domain.com', '1928200647', 'Ad illo consequatur maxime. Et iste neque laboriosam molestiae. Qui architecto maiores voluptatem sint doloribus.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(80, 'Chú. Kiều Cẩn', 'bthan@domain.com', '4082162309', 'Debitis consequatur et est nulla. Sapiente ut totam non et officia. Voluptatibus totam officia occaecati est ex autem ipsum. Alias ex distinctio accusamus.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(81, 'Cô. Nghiêm Chung', 'khanh93@domain.com', '7653519515', 'Omnis doloribus nesciunt est consequatur dolores soluta accusantium expedita. Aut est a eum non non. Ut voluptatem et tempora. Ab quis quia ut ducimus at occaecati.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(82, 'Em. Khúc Ngọc', 'bang.ty@domain.com', '0232287787', 'Et doloribus libero temporibus et dolorem. Ut qui temporibus vero. Reiciendis sit sit rerum est illum et. Saepe et illo natus libero. Sed aut ut sit deserunt perspiciatis debitis eum.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(83, 'Bà. Hình Hảo', 'van86@domain.com', '8700748817', 'Tempora nihil dolore aut voluptatem mollitia hic et. Itaque facilis nemo quia nisi laudantium. Beatae et ut repellendus et earum aut magni.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(84, 'Điền Nhượng', 'hiep.tran@domain.com', '1735623470', 'Eius non sit quam pariatur ipsam est odio. Magnam consectetur corporis quidem autem a. Dicta voluptas iste aspernatur debitis atque. Et id molestias libero placeat magnam rerum.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(85, 'Lều Phụng', 'vung99@domain.com', '6803503747', 'Eaque illum iure qui officiis sint sed excepturi sequi. Vitae recusandae inventore libero voluptate ut ipsum. Et possimus in aspernatur aliquid. Quia autem aut eius eos.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(86, 'Anh. Dã Luận', 'bach37@domain.com', '0191371000', 'Dolores exercitationem tempora hic porro odit. Quae placeat voluptatem veniam sit rem. Optio est et illo ex vitae aliquid. Dicta modi incidunt et voluptatem voluptate voluptates culpa.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(87, 'Trịnh Ngân Giao', 'bu.hoa@domain.com', '8588519080', 'Et quia est sed est sed quae ad. Assumenda in et dicta et consequuntur. Tempore sint vel tenetur.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(88, 'Cụ. Hy Ty', 'moc.yen@domain.com', '4026594562', 'Voluptas nesciunt architecto soluta qui esse praesentium. Doloribus sint vel et et aut minima et. Voluptate voluptatem voluptas quas id velit.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(89, 'Lạc Quân Thành', 'bninh@domain.com', '1911200241', 'Voluptas totam beatae necessitatibus autem tempore dignissimos. Ut impedit veritatis alias modi temporibus. Voluptas ut ipsum quas quis quae.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(90, 'Cụ. Giao Bằng Trường', 'trung.bi@domain.com', '0394554541', 'Quis aliquid ut voluptatibus hic ut amet. Eos cum doloremque magni qui debitis.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(91, 'Dương Lập', 'dmach@domain.com', '0906458522', 'Voluptatem asperiores at sed necessitatibus et facere. Voluptas sunt nemo minima vero. Magnam sint animi et. Magni sed iste aut excepturi soluta officia.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(92, 'Sử Khoát', 'thien01@domain.com', '7154726075', 'Non ipsam quisquam molestiae maxime ut exercitationem at. Et repellendus molestiae nihil optio eum voluptatem. Temporibus provident commodi hic laudantium porro et hic.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(93, 'Cát Nhuận', 'khanh99@domain.com', '7692665477', 'Voluptatem similique fugiat est tempora. Odit temporibus suscipit et eos fuga hic. Ipsa ad aut quia unde nam officiis quis.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(94, 'Ngô Vũ', 'thap.thac@domain.com', '8889553423', 'Veniam laboriosam et non expedita. Rerum dolores et aut. Vel sapiente et nihil maxime nihil.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(95, 'Văn Duyên', 'udoan@domain.com', '9689539137', 'Ipsa repudiandae optio beatae quaerat ut ducimus fugiat. Esse nihil et quod dignissimos. Repudiandae laboriosam sint et non id. Nisi est illum dolor quo totam dolore.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(96, 'Uông Bửu', 'hieu.anh@domain.com', '3967045785', 'Veritatis accusantium nesciunt distinctio. Et voluptates blanditiis unde. Ex sunt nobis nihil sint unde est ea.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(97, 'Cô. Bình Trâm Nhân', 'fdan@domain.com', '7102152901', 'Tenetur ipsa ipsa ut. Eligendi ut repellendus consequatur distinctio aperiam ut. Qui sed corporis esse veritatis.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(98, 'Triệu Loan An', 'tai.tiep@domain.com', '9124040737', 'Quia occaecati vel illo animi et provident sunt. Facilis molestiae architecto vel hic molestiae molestias.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(99, 'Em. Ấu Nhật Uy', 'qlo@domain.com', '7400654491', 'Aut voluptas aut consequatur debitis et necessitatibus et. Nesciunt sint est id maxime autem. Porro quis eveniet et voluptatem ipsam. Nulla qui quo hic omnis enim tenetur.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(100, 'Em. Lại Thu', 'chuong.yen@domain.com', '7664840616', 'Veniam minus amet et. Sit dolore laboriosam qui et eligendi mollitia blanditiis. Ut dolorem incidunt aut illum reiciendis. Aut officiis quibusdam doloribus sunt et eaque.', 1, '2023-02-07 07:16:22', '2023-02-07 07:16:22'),
(101, 'tessss111', 'admi222n@gmail.com', '1234567890', 'fsdfdầgdf', 1, '2023-02-08 07:23:48', '2023-02-08 07:23:48'),
(102, 'rthtjhr', 'adminr@gmail.com', '5647567567', 'gdfgsh', 1, '2023-02-13 00:59:04', '2023-02-13 00:59:04'),
(103, 'tessst', 'chanh@gmail.com', '3456456456', 'dgshfg', 1, '2023-02-13 04:54:42', '2023-02-13 04:54:42'),
(104, 'tessst', 'chanh@gmail.com', '3456456456', 'dgshfg', 1, '2023-02-13 04:55:01', '2023-02-13 04:55:01'),
(105, 'tessst', 'chanh@gmail.com', '3456456456', 'ghjfg', 1, '2023-02-13 04:57:24', '2023-02-13 04:57:24'),
(106, 'tessst', 'chanh@gmail.com', '3456456456', 'ghjfg', 1, '2023-02-13 05:01:07', '2023-02-13 05:01:07'),
(107, 'tessst', 'chanh55@gmail.com', '3456456456', 'Veniam minus amet et. Sit dolore laboriosam qui et eligendi mollitia blanditiis. Ut dolorem incidunt aut illum reiciendis.Veniam minus amet et. Sit dolore laboriosam qui et eligendi mollitia blanditiis. Ut dolorem incidunt aut illum reiciendis.', 1, '2023-02-13 05:01:57', '2023-02-14 06:38:21'),
(108, 'gdfgd', 'sfsafd@gmail.com', '3456456456', 'fgsdfgsdg', 1, '2023-02-14 07:52:18', '2023-02-14 07:52:18'),
(109, 'Customer1', 'custom1@domain.com', '7154726075', 'Non ipsam quisquam molestiae maxime ut exercitationem at. Et repellendus molestiae nihil optio eum voluptatem. Temporibus provident commodi hic laudantium porro et hic.', 1, '2023-02-14 08:06:30', '2023-02-14 08:06:30'),
(110, 'Customer2', 'custom2@domain.com', '9598933595', 'Voluptatem ut voluptatibus veritatis aspernatur modi. Nisi ad possimus assumenda et. Animi aut sed placeat et repellendus. Recusandae consequuntur et dolores aut. Voluptatibus qui odit dolorem.', 1, '2023-02-14 08:06:30', '2023-02-14 08:06:30'),
(111, 'Customer3', 'custom3@domain.com', '6966156558', 'Eligendi aliquid blanditiis quidem. Ipsum aut quia deleniti culpa. Sit consectetur ut adipisci quis deleniti.', 1, '2023-02-14 08:06:30', '2023-02-14 08:06:30'),
(112, 'Customer4', 'custom4@domain.com', '3262304344', 'Accusamus distinctio mollitia quia. Ipsum fugiat eligendi maiores dolorem perferendis rerum ratione iure. Omnis corrupti sequi voluptatibus ipsum itaque porro.', 1, '2023-02-14 08:06:30', '2023-02-14 08:06:30'),
(113, 'hfhsfgh', 'chanh@gmail.com', '5454356656', 'ggsd', 1, '2023-02-15 10:00:04', '2023-02-17 03:23:38'),
(114, 'tessst', 'chanh@gmail.com', '3456456456', 'ffhfh', 1, '2023-02-17 03:24:03', '2023-02-17 03:24:03'),
(115, 'Lemon66', 'chanh55@gmail.com', '3456456456', '645656hfghfg', 1, '2023-02-17 07:30:12', '2023-02-17 08:50:10');

-- --------------------------------------------------------

--
-- Table structure for table `mst_product`
--

CREATE TABLE `mst_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `product_price` decimal(8,2) NOT NULL DEFAULT 0.00,
  `description` text DEFAULT NULL,
  `is_sales` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0: Unavailable, 1: Available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mst_product`
--

INSERT INTO `mst_product` (`id`, `product_id`, `product_name`, `product_image`, `product_price`, `description`, `is_sales`, `created_at`, `updated_at`) VALUES
(2, 'T000000001', 'Tinder111', '1676597642_Untitled.png', '34.00', 'Tinder111', 1, '2023-02-16 01:28:14', '2023-02-17 01:34:41'),
(3, 'H000000001', 'hello', '1676541226_detail_2.png', '123.00', 'test', 1, '2023-02-16 09:45:32', '2023-02-16 09:53:46'),
(4, 'H000000002', 'hjhjhj', '1676595883_Screenshot_20221116_110820.png', '123.00', 'test', 1, '2023-02-16 09:50:54', '2023-02-17 01:04:43'),
(6, 'P000000003', 'Product1', '1676596261_Screenshot_20221116_110820.png', '3.00', 'fdfgsd', 0, '2023-02-17 01:11:01', '2023-02-17 04:08:26'),
(9, 'C000000001', 'Cindy111', '', '12.00', 'Voluptatem ut voluptatibus veritatis aspernatur modi. Nisi ad possimus assumenda et. 4444444', 1, '2023-02-17 04:00:25', '2023-02-17 04:00:25'),
(11, 'P000000004', 'Product1', '', '1.00', 'Voluptas velit reiciendis et sed est rerum. Quisquam sapiente est sit sapiente earum id nihil', 1, '2023-02-17 07:35:11', '2023-02-17 07:35:11'),
(12, 'P000000005', 'Product', '', '478.00', 'Voluptas velit reiciendis et sed est rerum.', 2, '2023-02-17 07:35:44', '2023-02-17 08:33:53'),
(13, 'D000000001', 'Dinoo', '', '233.00', 'Voluptas velit reiciendis et sed est rerum.', 1, '2023-02-17 07:39:21', '2023-02-17 08:33:04'),
(14, 'C000000002', 'Cindy0055', '', '3.00', 'Sann pham test', 1, '2023-02-17 08:38:06', '2023-02-17 08:38:06'),
(15, 'C000000003', 'Cinnddy', '1676623123_grapefruit-slice-332-332.jpg', '456.00', 'rtertrt222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222222', 1, '2023-02-17 08:38:43', '2023-02-20 04:23:42');

-- --------------------------------------------------------

--
-- Table structure for table `mst_shop`
--

CREATE TABLE `mst_shop` (
  `shop_id` tinyint(3) UNSIGNED NOT NULL,
  `shop_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mst_users`
--

CREATE TABLE `mst_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `verify_email` varchar(100) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0: Inactive, 1: Active',
  `is_delete` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: Normal, 1: Deleted',
  `group_role` varchar(50) NOT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `last_login_ip` varchar(40) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mst_users`
--

INSERT INTO `mst_users` (`id`, `name`, `email`, `password`, `remember_token`, `verify_email`, `is_active`, `is_delete`, `group_role`, `last_login_at`, `last_login_ip`, `created_at`, `updated_at`) VALUES
(2, 'Admin', 'admin@gmail.com', '$2y$10$l2Wtf8cin4haMqApAxh9X.Cxbg8svJWfQIKSBZ78DGHRu5Z2I2fti', 'SwmGS8YKOhKQ8hTd39abiNt1liGRtllXS0yBZB98PLd8VEnkI0yIkMvJMNC4', NULL, 1, 0, 'Admin', '2023-02-20 03:15:46', '127.0.0.1', '2023-02-05 20:02:34', '2023-02-20 03:15:46'),
(3, 'Mathias Abernathy', 'hershel.hartmann@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'cFhmXV25YK', NULL, 1, 0, 'Reviewer', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(4, 'Juston Johns PhD', 'ada84@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ftvtHYJ5ND', NULL, 1, 0, 'Admin', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(5, 'Mrs. Bethel King III', 'alvis01@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'O80qFVWnB1', NULL, 1, 0, 'Admin', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(6, 'Coby Koepp', 'ubaumbach@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0BLjCohJH6', NULL, 1, 0, 'Admin', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(7, 'Macie Towne', 'eliseo98@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'IO45gDWk0U', NULL, 1, 0, 'Reviewer', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(8, 'Curt Nader', 'jaden20@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '5E45M0y0rd', NULL, 1, 0, 'Reviewer', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(9, 'Dr. Elena Cole Jr.', 'haven30@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'uHtmfLsM09', NULL, 1, 0, 'Editor', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(10, 'Mrs. Phoebe Hudson III', 'kihn.clifton@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '7suCZk9ObK', NULL, 1, 0, 'Admin', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(11, 'Dr. Raphaelle Effertz', 'david.mills@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'cPDv1Qdyeb', NULL, 1, 0, 'Admin', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(12, 'Gloria Leuschke PhD', 'matteo62@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'W4GqkqtIAi', NULL, 1, 0, 'Editor', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(13, 'Delpha Zulauf', 'kulas.bertram@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'zwU8Ndl7qU', NULL, 1, 0, 'Admin', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(14, 'Delfina Glover', 'elinore.cartwright@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '4AJZktRGMK', NULL, 1, 0, 'Reviewer', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(15, 'Stefanie Pagac', 'garfield23@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'YkUWwXGvyl', NULL, 1, 0, 'Editor', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(16, 'Candida Cronin MD', 'wuckert.edwin@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'qweyJSUrIk', NULL, 1, 0, 'Admin', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(18, 'Nora McLaughlin', 'lreynolds@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'NlVUkNdaUK', NULL, 1, 0, 'Admin', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(19, 'Mallie Nienow', 'vvon@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'WtFDrWXc4t', NULL, 1, 0, 'Admin', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(20, 'Skylar Mraz', 'lboyer@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'evpYEMNbUR', NULL, 1, 0, 'Editor', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(21, 'Mr. Guy Marquardt Jr.', 'giovanna.jast@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'p2ndkil4tU', NULL, 1, 0, 'Admin', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(22, 'Kristopher Wehner', 'jeffrey34@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '8taIDyqNQP', NULL, 1, 0, 'Reviewer', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(23, 'Antonietta Ernser', 'considine.rylan@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ipEnZOurac', NULL, 1, 0, 'Editor', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(24, 'Dr. Scottie Tromp Jr.', 'freichel@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'EQYL2S2XMk', NULL, 0, 0, 'Editor', NULL, NULL, '2023-02-07 01:11:52', '2023-02-20 06:19:03'),
(25, 'Dr. Lily Kuhic Sr.', 'letitia52@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'M9UFisKbwn', NULL, 1, 0, 'Admin', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(26, 'Mireille Kirlin', 'lavonne18@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '9YM3oLLg29', NULL, 1, 0, 'Admin', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(27, 'Miss Yoshiko Hoppe', 'rosemarie79@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'MHXjTTpfED', NULL, 1, 0, 'Reviewer', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(28, 'Antone Wisozk', 'bmaggio@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'u8VKqLjPLB', NULL, 1, 0, 'Admin', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(29, 'Maybell Gleason', 'ikassulke@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'zrr9KglJTo', NULL, 1, 0, 'Admin', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(30, 'Chadrick Dare DDS', 'wtorp@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'UQycUDqXPK', NULL, 1, 0, 'Editor', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(31, 'Leonard Bauch', 'ullrich.priscilla@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'IqHwJpQ5yb', NULL, 1, 0, 'Reviewer', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(32, 'Alden Howell DVM', 'zking@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'v17hO9fSuG', NULL, 1, 0, 'Editor', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(33, 'Tristian Maggio', 'gfriesen@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'g3HrsUzdik', NULL, 1, 0, 'Reviewer', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(34, 'Santino Schulist', 'boyer.jacinto@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'CxQOKbDzbV', NULL, 1, 0, 'Admin', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(35, 'Prof. Zoey Morar', 'annette.shields@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'naw3epTwKj', NULL, 1, 0, 'Reviewer', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(36, 'Arnold Schaefer IV', 'estrella52@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'NFYWeOryDk', NULL, 1, 0, 'Admin', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(37, 'Marcelo McClure PhD', 'rau.drew@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'x41r8aPmT3', NULL, 1, 0, 'Admin', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(38, 'Lillie Bruen', 'heaney.abdul@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '5imGnn92Vk', NULL, 1, 0, 'Editor', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(39, 'Christopher King MD', 'mrohan@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'GidgjdSKlB', NULL, 1, 0, 'Reviewer', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(40, 'Edwin Cartwright Jr.', 'bschumm@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'lld3tmgy0u', NULL, 1, 0, 'Admin', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(41, 'Clyde Haley', 'gutkowski.audreanne@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'qUkKrmYrNl', NULL, 1, 0, 'Admin', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(42, 'Rickey Sanford', 'ibrahim74@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Hko4JKEmaH', NULL, 1, 0, 'Editor', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(43, 'Tyrell Baumbach II', 'mmraz@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'r3PzPcQsus', NULL, 1, 0, 'Editor', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(44, 'Roger Daugherty', 'ahirthe@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ttmH3yPfHI', NULL, 0, 0, 'Editor', NULL, NULL, '2023-02-07 01:11:52', '2023-02-20 06:18:12'),
(45, 'Dayana Feeney V', 'fadel.kip@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'q7w7ILYnlI', NULL, 1, 0, 'Reviewer', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(46, 'Dr. Brice Cole I', 'verdie81@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'RepVYUyH0O', NULL, 1, 0, 'Reviewer', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(47, 'Dr. Demarcus Gutmann III', 'hunter65@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'UJ3F4JM8Va', NULL, 1, 0, 'Admin', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(48, 'Liana Gerhold', 'iledner@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1z1tEq6h6z', NULL, 1, 0, 'Reviewer', NULL, NULL, '2023-02-07 01:11:52', '2023-02-17 02:57:51'),
(49, 'Daija Robel', 'raynor.alaina@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'dsJPY4jfMj', NULL, 1, 0, 'Editor', NULL, NULL, '2023-02-07 01:11:52', '2023-02-17 02:57:57'),
(50, 'Prof. Cordelia Price Sr.', 'dschmitt@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'sxFXfT2kBQ', NULL, 1, 0, 'Reviewer', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(51, 'Noemi Beahan', 'stanton.isai@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'wnV4CvsaeG', NULL, 1, 0, 'Reviewer', NULL, NULL, '2023-02-07 01:11:52', '2023-02-07 01:11:52'),
(52, 'Evie Boyer 1', 'cokeefe@domain.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'rHQF5sjjhT', NULL, 1, 0, 'Admin', NULL, NULL, '2023-02-07 01:11:52', '2023-02-14 01:34:04'),
(53, 'chanh', 'chanh@gmail.com', '$2y$10$UgfCNEdC4elxXfMj5zQaQuWe3Yor9QJHejCUxh3A7spv8MouCkxje', NULL, NULL, 1, 0, 'Admin', NULL, NULL, '2023-02-08 03:11:40', '2023-02-08 03:11:40'),
(54, 'fsdfdg', 'fsdfdg@gmail.com', '$2y$10$BCZxRP8mxSx6kFCYC2hr8OebZgDmrPZ0PLfLJGY6UA8JHMIfixo1S', NULL, NULL, 1, 0, 'Admin', NULL, NULL, '2023-02-08 03:15:59', '2023-02-08 03:15:59'),
(55, 'tessss111', 'fghf5756756@gmail.com', '$2y$10$qmWJJQDLO2bVPN3ZcOPD/u/NeW4Eu.Bb0EJm33l0vE9l5Gu8WiONy', NULL, NULL, 1, 0, 'Editor', NULL, NULL, '2023-02-08 04:24:13', '2023-02-13 08:29:37'),
(56, 'tessss1133', 'admin3@gmail.com', '$2y$10$1WlGKX3L5aeEqv0xqD97Ge8v5.1C/8b.oQsvwjU0Nd4.hlJcpPgvC', NULL, NULL, 1, 0, 'Editor', NULL, NULL, '2023-02-13 08:08:43', '2023-02-14 01:29:52'),
(57, 'Lemon', 'lemon97@gmail.com', '$2y$10$eAHu6vmJfBMQudQvO/oW8emMD/OcIEx6DxnkxgqPHirVZfthuviMS', NULL, NULL, 1, 0, 'Editor', NULL, NULL, '2023-02-14 04:35:55', '2023-02-15 08:14:24'),
(58, 'Alma111112', 'alma2909@gmail.com', '$2y$10$k3g/mlwzGeAjbYQu8Fyp0.pG7nBeK/FCRqcTMoX.KE9MBfZF2pfeO', NULL, NULL, 1, 0, 'Admin', NULL, NULL, '2023-02-15 08:38:31', '2023-02-17 03:04:01'),
(59, 'admintest', 'test123@gmail.com', '$2y$10$N1B4ZJL3KU3o.wHEi2B0G.Oi1qgprHO59D08eJaq.rFbrz7Lc5t2S', NULL, NULL, 1, 0, 'Admin', '2023-02-17 01:56:46', '192.168.99.30', '2023-02-17 01:48:08', '2023-02-17 03:04:15'),
(60, 'Lemon', 'lemon12@gmail.com', '$2y$10$/Rmv3efyKjH03OrnnKh3CuijtofRl39qKHovQTWceppnDj7AdSZYq', NULL, NULL, 0, 0, 'Admin', NULL, NULL, '2023-02-17 03:05:19', '2023-02-17 03:06:46'),
(61, 'Lemon44', 'lemon44@gmail.com', '$2y$10$uCiN7XzJy/NE9LGjjmx0XOpEtorygNeXhJJ34mPgro8kP7C/.E7Ci', NULL, NULL, 1, 0, 'Editor', NULL, NULL, '2023-02-17 03:07:16', '2023-02-17 03:07:16'),
(62, 'Lemon99', 'lemon99@gmail.com', '$2y$10$FJHozHrxRte1YGoKOOo2weyhybk2IX89DTU3vmN9iRXIsOFKyJ2QG', NULL, NULL, 1, 0, 'Editor', NULL, NULL, '2023-02-17 03:08:32', '2023-02-17 03:08:32'),
(63, 'Lemon86', 'lemon86@gmail.com', '$2y$10$uNPilwo4j8lwTxBD18c9Ve.w5gDYjA7Dv3.pp1Tur4C5ix0qwsZTO', NULL, NULL, 0, 0, 'Admin', NULL, NULL, '2023-02-17 07:28:26', '2023-02-17 08:40:27'),
(64, 'Lemon97', 'Lemon34@gmail.com', '$2y$10$3zqvWs71Ib/qhGvrBF24b.NnMnzwhczvMIv4Moaomo3G.TmETzRFq', NULL, NULL, 0, 0, 'Editor', '2023-02-17 08:46:40', '192.168.88.15', '2023-02-17 08:45:31', '2023-02-17 08:46:40');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_group`
--

CREATE TABLE `product_group` (
  `prex_group` varchar(255) NOT NULL,
  `index` bigint(20) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_group`
--

INSERT INTO `product_group` (`prex_group`, `index`, `created_at`, `updated_at`) VALUES
('C', 1, '2023-02-17 04:00:25', '2023-02-17 04:00:25'),
('C', 2, '2023-02-17 08:38:06', '2023-02-17 08:38:06'),
('C', 3, '2023-02-17 08:38:43', '2023-02-17 08:38:43'),
('D', 1, '2023-02-17 07:39:21', '2023-02-17 07:39:21'),
('H', 1, '2023-02-16 09:45:32', '2023-02-16 09:45:32'),
('H', 2, '2023-02-16 09:50:54', '2023-02-16 09:50:54'),
('P', 1, '2023-02-16 01:26:08', '2023-02-16 01:26:08'),
('P', 2, '2023-02-17 01:09:09', '2023-02-17 01:09:09'),
('P', 3, '2023-02-17 01:11:01', '2023-02-17 01:11:01'),
('P', 4, '2023-02-17 07:35:11', '2023-02-17 07:35:11'),
('P', 5, '2023-02-17 07:35:44', '2023-02-17 07:35:44'),
('T', 1, '2023-02-16 01:28:14', '2023-02-16 01:28:14'),
('T', 2, '2023-02-17 01:36:24', '2023-02-17 01:36:24'),
('T', 3, '2023-02-17 04:54:48', '2023-02-17 04:54:48'),
('Z', 1, '2023-02-17 02:26:02', '2023-02-17 02:26:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_customer`
--
ALTER TABLE `mst_customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `mst_customer_customer_id_unique` (`customer_id`);

--
-- Indexes for table `mst_product`
--
ALTER TABLE `mst_product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mst_product_product_id_unique` (`product_id`);

--
-- Indexes for table `mst_shop`
--
ALTER TABLE `mst_shop`
  ADD PRIMARY KEY (`shop_id`),
  ADD UNIQUE KEY `mst_shop_shop_id_unique` (`shop_id`);

--
-- Indexes for table `mst_users`
--
ALTER TABLE `mst_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mst_users_email_unique` (`email`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `product_group`
--
ALTER TABLE `product_group`
  ADD PRIMARY KEY (`prex_group`,`index`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mst_customer`
--
ALTER TABLE `mst_customer`
  MODIFY `customer_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `mst_product`
--
ALTER TABLE `mst_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `mst_shop`
--
ALTER TABLE `mst_shop`
  MODIFY `shop_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mst_users`
--
ALTER TABLE `mst_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
