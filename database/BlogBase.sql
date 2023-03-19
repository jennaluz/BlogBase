-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 19, 2023 at 01:02 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `BlogBase`
--

-- --------------------------------------------------------

--
-- Table structure for table `Ads`
--

CREATE TABLE `Ads` (
  `ad_id` int(11) NOT NULL,
  `ad_file` varchar(255) NOT NULL,
  `submit_date` date NOT NULL DEFAULT current_timestamp(),
  `price_paid` int(11) NOT NULL DEFAULT 50
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Articles`
--

CREATE TABLE `Articles` (
  `article_id` int(11) NOT NULL,
  `title` varchar(225) NOT NULL,
  `description` tinytext NOT NULL,
  `content` longblob NOT NULL,
  `submit_date` date NOT NULL DEFAULT current_timestamp(),
  `approved` tinyint(1) NOT NULL DEFAULT 0,
  `click_number` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Articles`
--

INSERT INTO `Articles` (`article_id`, `title`, `description`, `content`, `submit_date`, `approved`, `click_number`) VALUES
(1, 'An Alluring Amphibian', '<p>Frogs are a diverse group of amphibians that can be found all over the world. There are more than 7,000 species of frogs, and they come in a wide range of shapes, sizes, and colors. Frogs are fascinating creatures that play an important role in many ', 0x3c703e46726f677320617265206120646976657273652067726f7570206f6620616d7068696269616e7320746861742063616e20626520666f756e6420616c6c206f7665722074686520776f726c642e20546865726520617265206d6f7265207468616e20372c3030302073706563696573206f662066726f67732c20616e64207468657920636f6d6520696e206120776964652072616e6765206f66207368617065732c2073697a65732c20616e6420636f6c6f72732e2046726f6773206172652066617363696e6174696e6720637265617475726573207468617420706c617920616e20696d706f7274616e7420726f6c6520696e206d616e792065636f73797374656d732c20616e64207468657920686176652063617074757265642074686520696d6167696e6174696f6e206f662070656f706c6520666f722074686f7573616e6473206f662079656172732e3c2f703e0d0a0d0a3c703e506879736963616c204368617261637465726973746963733c2f703e0d0a0d0a3c703e46726f677320617265206b6e6f776e20666f7220746865697220756e6971756520706879736963616c206368617261637465726973746963732c207375636820617320746865697220736d6f6f74682c206d6f69737420736b696e20616e64207468656972206c6f6e672c20706f77657266756c2068696e64206c6567732e204d6f73742073706563696573206f662066726f677320686176652077656262656420666565742c2077686963682068656c70207468656d20746f207377696d20656666696369656e746c792e2046726f677320616c736f20686176652061206c6f6e672c20737469636b7920746f6e677565207468617420746865792075736520746f20636174636820707265792e3c2f703e0d0a0d0a3c703e46726f677320636f6d6520696e206120776964652072616e6765206f662073697a65732c2066726f6d207468652074696e7920506165646f706872796e6520616d6175656e7369732c207768696368206d65617375726573206a75737420372e37206d696c6c696d657465727320696e206c656e6774682c20746f20746865206769616e7420476f6c696174682066726f672c2077686963682063616e2067726f7720757020746f2033322063656e74696d6574657273206c6f6e6720616e64207765696768206d6f7265207468616e2033206b696c6f6772616d732e2046726f67732063616e20616c736f20766172792067726561746c7920696e20636f6c6f7220616e64207061747465726e2c207769746820736f6d652073706563696573206265696e67206272696768746c7920636f6c6f72656420616e64206f7468657273206265696e67206d6f7265206d757465642e3c2f703e0d0a0d0a3c703e486162697461747320616e6420446973747269627574696f6e3c2f703e0d0a0d0a3c703e46726f67732063616e20626520666f756e6420696e206120776964652072616e6765206f662068616269746174732c20696e636c7564696e6720666f72657374732c2067726173736c616e64732c20646573657274732c20616e64206576656e20757262616e2061726561732e204d616e792073706563696573206f662066726f677320617265206171756174696320616e64206c69766520696e20706f6e64732c206c616b65732c20616e642073747265616d732e204f746865722073706563696573206c697665206f6e206c616e6420616e64206f6e6c7920766973697420776174657220746f2062726565642e3c2f703e0d0a0d0a3c703e46726f67732061726520666f756e64206f6e20657665727920636f6e74696e656e742065786365707420416e74617263746963612c20616e64207468657920617265206d6f7374206162756e64616e7420696e2074726f706963616c20726567696f6e732e20536f6d65206f6620746865206d6f737420646976657273652066726f6720706f70756c6174696f6e732061726520666f756e6420696e2074686520416d617a6f6e207261696e666f726573742c207768657265206d6f7265207468616e203530302073706563696573206f662066726f67732068617665206265656e206964656e7469666965642e3c2f703e0d0a0d0a3c703e4265686176696f7220616e6420446965743c2f703e0d0a0d0a3c703e46726f67732061726520636f6c642d626c6f6f64656420616e696d616c732c207768696368206d65616e73207468617420746865697220626f64792074656d706572617475726520697320726567756c6174656420627920746865697220656e7669726f6e6d656e742e20546865792061726520616c736f207665727920616461707461626c652063726561747572657320616e64206172652061626c6520746f2061646a757374207468656972206265686176696f7220616e642070687973696f6c6f677920746f207375697420746865697220737572726f756e64696e67732e3c2f703e0d0a0d0a3c703e46726f677320617265207072696d6172696c79206361726e69766f726f757320616e642066656564206f6e206120776964652072616e6765206f6620707265792c20696e636c7564696e6720696e73656374732c20737069646572732c20776f726d732c20616e64206f7468657220736d616c6c20616e696d616c732e20536f6d652073706563696573206f662066726f677320617265206576656e206b6e6f776e20746f20656174206f746865722066726f67732e3c2f703e0d0a0d0a3c703e526570726f64756374696f6e3c2f703e0d0a0d0a3c703e526570726f64756374696f6e20697320616e20696d706f7274616e742070617274206f66207468652066726f67206c696665206379636c652c20616e64206974206f6674656e20696e766f6c76657320636f6d706c6578206265686176696f727320616e642061646170746174696f6e732e20496e206d616e7920737065636965732c206d616c65732077696c6c2075736520766f63616c697a6174696f6e7320616e6420706879736963616c20646973706c61797320746f20617474726163742066656d616c65732e204f6e636520612066656d616c65206861732063686f73656e2061206d6174652c2074686520706169722077696c6c20656e6761676520696e206120756e6971756520666f726d206f6620726570726f64756374696f6e2063616c6c656420616d706c657875732c20776865726520746865206d616c6520636c61737073207468652066656d616c6520616e642066657274696c697a657320686572206567677320617320736865206c617973207468656d2e3c2f703e0d0a0d0a3c703e4166746572207468652065676773206172652066657274696c697a65642c207468657920646576656c6f7020696e746f20746164706f6c65732c20776869636820617265206171756174696320616e6420686176652067696c6c7320666f7220627265617468696e6720756e64657277617465722e2041732074686579206d61747572652c20746164706f6c65732077696c6c20646576656c6f70206c756e677320616e64206c65677320616e64206576656e7475616c6c79206d6574616d6f7270686f736520696e746f206164756c742066726f67732e3c2f703e0d0a0d0a3c703e496d706f7274616e636520696e2045636f73797374656d733c2f703e0d0a0d0a3c703e46726f677320706c617920616e20696d706f7274616e7420726f6c6520696e206d616e792065636f73797374656d7320616e6420617265206f6674656e20726566657272656420746f20617320696e64696361746f72207370656369657320626563617573652074686579206172652073656e73697469766520746f206368616e67657320696e20746865697220656e7669726f6e6d656e742e20546865792061726520616c736f20696d706f7274616e74207072656461746f72732c20616e6420746865697220646965742068656c707320746f20636f6e74726f6c2074686520706f70756c6174696f6e73206f66206d616e7920696e736563747320616e64206f7468657220736d616c6c20616e696d616c732e3c2f703e0d0a0d0a3c703e556e666f7274756e6174656c792c206d616e792073706563696573206f662066726f67732061726520746872656174656e65642062792068616269746174206c6f73732c20706f6c6c7574696f6e2c20636c696d617465206368616e67652c20616e64206f746865722068756d616e20616374697669746965732e20436f6e736572766174696f6e206566666f7274732061726520756e64657277617920746f2070726f7465637420746865736520696d706f7274616e7420616e696d616c7320616e6420656e737572652074686174207468657920636f6e74696e756520746f2074687269766520696e207468652077696c642e3c2f703e0d0a0d0a3c703e436f6e636c7573696f6e3c2f703e0d0a0d0a3c703e46726f67732061726520612066617363696e6174696e6720616e6420696d706f7274616e742067726f7570206f6620616e696d616c7320746861742061726520666f756e6420616c6c206f7665722074686520776f726c642e205769746820746865697220756e6971756520706879736963616c206368617261637465726973746963732c20646976657273652068616269746174732c20616e6420696d706f7274616e7420726f6c6520696e206d616e792065636f73797374656d732c2066726f677320686176652063617074757265642074686520696d6167696e6174696f6e206f662070656f706c6520666f722074686f7573616e6473206f662079656172732e204279206c6561726e696e67206d6f72652061626f757420746865736520616d617a696e672063726561747572657320616e6420737570706f7274696e6720636f6e736572766174696f6e206566666f7274732c2077652063616e2068656c7020746f20656e737572652074686174207468657920636f6e74696e756520746f2074687269766520666f722067656e65726174696f6e7320746f20636f6d652e3c2f703e0d0a0d0a3c703e5772697474656e20627920436861744750542e3c2f703e0d0a, '2023-03-16', 1, 0),
(2, 'Staying Safe Online: Tips for Protecting Yourself on the Internet', '<p>The internet has revolutionized the way we live and work, but it has also created new risks and challenges. As more of our personal and professional lives move online, it&#39;s increasingly important to be vigilant and take steps to protect ourselves', 0x3c703e54686520696e7465726e657420686173207265766f6c7574696f6e697a65642074686520776179207765206c69766520616e6420776f726b2c206275742069742068617320616c736f2063726561746564206e6577207269736b7320616e64206368616c6c656e6765732e204173206d6f7265206f66206f757220706572736f6e616c20616e642070726f66657373696f6e616c206c69766573206d6f7665206f6e6c696e652c206974262333393b7320696e6372656173696e676c7920696d706f7274616e7420746f20626520766967696c616e7420616e642074616b6520737465707320746f2070726f74656374206f757273656c7665732066726f6d20637962657220746872656174732e20486572652061726520736f6d65207469707320666f722073746179696e672073616665206f6e6c696e653a3c2f703e0d0a0d0a3c6f6c3e0d0a093c6c693e0d0a093c703e557365207374726f6e672070617373776f7264733a204f6e65206f6620746865206d6f737420696d706f7274616e74207468696e677320796f752063616e20646f20746f2070726f7465637420796f757273656c66206f6e6c696e6520697320746f20757365207374726f6e672070617373776f7264732e2041207374726f6e672070617373776f7264206973206174206c656173742031322063686172616374657273206c6f6e6720616e6420696e636c756465732061206d6978206f6620757070657220616e64206c6f77657263617365206c6574746572732c206e756d626572732c20616e642073796d626f6c732e2041766f6964207573696e6720636f6d6d6f6e20776f726473206f7220706872617365732c20616e6420646f6e262333393b742072657573652070617373776f726473206163726f737320646966666572656e74206163636f756e74732e3c2f703e0d0a093c2f6c693e0d0a093c6c693e0d0a093c703e456e61626c652074776f2d666163746f722061757468656e7469636174696f6e3a2054776f2d666163746f722061757468656e7469636174696f6e206164647320616e206578747261206c61796572206f6620736563757269747920746f20796f7572206163636f756e747320627920726571756972696e6720796f7520746f2070726f766964652061207365636f6e6420666f726d206f66206964656e74696669636174696f6e2c2073756368206173206120636f64652073656e7420746f20796f75722070686f6e652c20696e206164646974696f6e20746f20796f75722070617373776f72642e204d616e79206f6e6c696e65207365727669636573206e6f77206f666665722074686973206f7074696f6e2c20616e64206974262333393b7320776f7274682074616b696e6720616476616e74616765206f662e3c2f703e0d0a093c2f6c693e0d0a093c6c693e0d0a093c703e4b65657020796f757220736f66747761726520757020746f20646174653a20536f6674776172652075706461746573206f6674656e20696e636c75646520696d706f7274616e742073656375726974792066697865732c20736f206974262333393b7320696d706f7274616e7420746f206b65657020796f7572206f7065726174696e672073797374656d2c207765622062726f777365722c20616e64206f7468657220736f66747761726520757020746f20646174652e2053657420796f757220636f6d707574657220616e64206f74686572206465766963657320746f206175746f6d61746963616c6c792075706461746520736f6674776172652c206f7220636865636b20666f72207570646174657320726567756c61726c792e3c2f703e0d0a093c2f6c693e0d0a093c6c693e0d0a093c703e42652063617574696f7573206f66207068697368696e67207363616d733a205068697368696e67207363616d732061726520617474656d70747320746f20747269636b20796f7520696e746f2070726f766964696e672073656e73697469766520696e666f726d6174696f6e2c207375636820617320796f75722070617373776f7264206f72206372656469742063617264206e756d6265722c20627920706f73696e672061732061206c65676974696d617465206f7267616e697a6174696f6e206f7220696e646976696475616c2e2042652077617279206f6620656d61696c732c2074657874206d657373616765732c206f722070686f6e652063616c6c7320746861742061736b20666f7220796f757220706572736f6e616c20696e666f726d6174696f6e2c20616e64206e6576657220636c69636b206f6e206c696e6b7320696e20737573706963696f757320656d61696c732e3c2f703e0d0a093c2f6c693e0d0a093c6c693e0d0a093c703e5573652061207669727475616c2070726976617465206e6574776f726b202856504e293a20412056504e20656e63727970747320796f757220696e7465726e657420636f6e6e656374696f6e20616e642068656c70732070726f7465637420796f7572206f6e6c696e65207072697661637920627920686964696e6720796f7572204950206164647265737320616e64206c6f636174696f6e2e20496620796f7520757365207075626c69632057692d4669206672657175656e746c792c20636f6e7369646572207573696e6720612056504e20746f2068656c702070726f7465637420796f75722073656e73697469766520696e666f726d6174696f6e2e3c2f703e0d0a093c2f6c693e0d0a093c6c693e0d0a093c703e4265206361726566756c207768617420796f75207368617265206f6e6c696e653a205468696e6b207477696365206265666f72652073686172696e6720706572736f6e616c20696e666f726d6174696f6e206f6e6c696e652c20696e636c7564696e67206f6e20736f6369616c206d656469612e2042652063617574696f7573206f66206f76657273686172696e67206f722070726f766964696e6720696e666f726d6174696f6e207468617420636f756c64206265207573656420746f20696d706572736f6e61746520796f75206f7220737465616c20796f7572206964656e746974792e3c2f703e0d0a093c2f6c693e0d0a093c6c693e0d0a093c703e4d6f6e69746f7220796f7572206163636f756e747320616e6420637265646974207265706f7274733a20526567756c61726c7920636865636b696e6720796f75722062616e6b20616e642063726564697420636172642073746174656d656e74732063616e2068656c7020796f752064657465637420756e617574686f72697a65642061637469766974792c20616e6420636865636b696e6720796f757220637265646974207265706f72742063616e2068656c7020796f752073706f74207369676e73206f66206964656e746974792074686566742e20436f6e73696465722073657474696e6720757020616c6572747320666f7220756e757375616c206163746976697479206f6e20796f7572206163636f756e74732e3c2f703e0d0a093c2f6c693e0d0a093c6c693e0d0a093c703e55736520616e7469766972757320736f6674776172653a20416e7469766972757320736f6674776172652063616e2068656c702070726f7465637420796f757220636f6d70757465722066726f6d206d616c7761726520616e64206f7468657220637962657220746872656174732e204d616b65207375726520746f206b65657020796f757220616e7469766972757320736f66747761726520757020746f206461746520616e642072756e20726567756c6172207363616e73206f6620796f757220636f6d70757465722e3c2f703e0d0a093c2f6c693e0d0a093c6c693e0d0a093c703e4261636b20757020696d706f7274616e7420646174613a20526567756c61726c79206261636b696e6720757020696d706f7274616e7420646174612c207375636820617320646f63756d656e74732c2070686f746f732c20616e6420766964656f732c2063616e2068656c7020796f75207265636f7665722066726f6d20612063796265722061747461636b206f72206f746865722064697361737465722e20436f6e7369646572207573696e67206120636c6f7564206261636b75702073657276696365206f7220616e2065787465726e616c206861726420647269766520746f2073746f726520796f7572206261636b7570732e3c2f703e0d0a093c2f6c693e0d0a093c6c693e0d0a093c703e4564756361746520796f757273656c663a2046696e616c6c792c207374617920696e666f726d65642061626f757420746865206c6174657374206379626572207468726561747320616e6420626573742070726163746963657320666f722073746179696e672073616665206f6e6c696e652e2052656164206f6e6c696e65207365637572697479206e65777320616e6420746970732c20616e6420636f6e73696465722074616b696e67206f6e6c696e6520636f7572736573206f7220617474656e64696e6720776f726b73686f707320746f206c6561726e206d6f72652061626f7574206f6e6c696e652073656375726974792e3c2f703e0d0a093c2f6c693e0d0a3c2f6f6c3e0d0a0d0a3c703e427920666f6c6c6f77696e6720746865736520746970732c20796f752063616e2068656c702070726f7465637420796f757273656c662066726f6d206379626572207468726561747320616e6420737461792073616665206f6e6c696e652e2052656d656d62657220746f20626520766967696c616e7420616e642063617574696f75732c20616e6420616c77617973207468696e6b207477696365206265666f72652073686172696e6720706572736f6e616c20696e666f726d6174696f6e206f7220636c69636b696e67206f6e206c696e6b732066726f6d20756e6b6e6f776e20736f75726365732e3c2f703e0d0a, '2023-03-17', 1, 0),
(3, 'Embedded Systems Programming with Rust: The Future of Low-Level Development', '<div id=\"article-body\">\r\n<p>Embedded systems programming has traditionally been done using low-level languages like C or assembly, but in recent years, Rust has emerged as a popular alternative due to its memory safety, performance, and expressive synta', 0x3c6469762069643d2261727469636c652d626f6479223e0d0a3c703e456d6265646465642073797374656d732070726f6772616d6d696e672068617320747261646974696f6e616c6c79206265656e20646f6e65207573696e67206c6f772d6c6576656c206c616e677561676573206c696b652043206f7220617373656d626c792c2062757420696e20726563656e742079656172732c20527573742068617320656d6572676564206173206120706f70756c617220616c7465726e61746976652064756520746f20697473206d656d6f7279207361666574792c20706572666f726d616e63652c20616e6420657870726573736976652073796e7461782e205275737420697320612073797374656d732070726f6772616d6d696e67206c616e6775616765207468617420636f6d62696e6573206c6f772d6c6576656c20636f6e74726f6c207769746820686967682d6c6576656c206162737472616374696f6e732c206d616b696e672069742077656c6c2d73756974656420666f7220656d6265646465642073797374656d732070726f6772616d6d696e672e3c2f703e0d0a0d0a3c703e5768617420697320527573743f3c2f703e0d0a0d0a3c703e5275737420697320612073797374656d732070726f6772616d6d696e67206c616e677561676520746861742077617320646576656c6f706564206279204d6f7a696c6c6120696e20323031302e204974207761732064657369676e656420746f206164647265737320736f6d65206f66207468652073686f7274636f6d696e6773206f66204320616e6420432b2b207768696c65207374696c6c2070726f766964696e67206c6f772d6c6576656c20636f6e74726f6c20616e64206869676820706572666f726d616e63652e2052757374206973206120636f6d70696c6564206c616e677561676520746861742070726f76696465732061206e756d626572206f662066656174757265732074686174206d616b652069742077656c6c2d73756974656420666f7220656d6265646465642073797374656d732070726f6772616d6d696e672c20696e636c7564696e673a3c2f703e0d0a0d0a3c756c3e0d0a093c6c693e0d0a093c703e4d656d6f7279207361666574793a20527573742075736573206120636f6e636570742063616c6c6564206f776e65727368697020746f206d616e616765206d656d6f72792c2077686963682068656c70732070726576656e7420636f6d6d6f6e206d656d6f72792d72656c61746564206572726f7273206c696b6520627566666572206f766572666c6f77732c206e756c6c20706f696e7465722064657265666572656e6365732c20616e64207573652d61667465722d66726565206572726f72732e2054686973206d616b6573206974206d7563682065617369657220746f207772697465207361666520616e642072656c6961626c6520636f646520666f7220656d6265646465642073797374656d732e3c2f703e0d0a093c2f6c693e0d0a093c6c693e0d0a093c703e5a65726f2d636f7374206162737472616374696f6e733a20527573742070726f76696465732061206e756d626572206f6620686967682d6c6576656c206162737472616374696f6e732c206c696b6520636c6f737572657320616e64206974657261746f72732c2074686174206d616b65206974206561737920746f207772697465206578707265737369766520636f646520776974686f7574207361637269666963696e6720706572666f726d616e63652e205468657365206162737472616374696f6e73206172652064657369676e656420746f20626520636f6d70696c656420646f776e20746f206c6f772d6c6576656c20636f64652074686174206973206a75737420617320656666696369656e742061732068616e642d7772697474656e2043206f7220617373656d626c792e3c2f703e0d0a093c2f6c693e0d0a093c6c693e0d0a093c703e436f6e63757272656e63793a20527573742070726f7669646573206275696c742d696e20737570706f727420666f7220636f6e63757272656e637920616e6420706172616c6c656c69736d2c206d616b696e67206974206561737920746f20777269746520636f646520746861742074616b657320616476616e74616765206f66206d756c7469706c6520636f726573206f7220686172647761726520746872656164732e3c2f703e0d0a093c2f6c693e0d0a093c6c693e0d0a093c703e436172676f3a2052757374262333393b73207061636b616765206d616e616765722c20436172676f2c206d616b6573206974206561737920746f206d616e61676520646570656e64656e636965732c206275696c642070726f6a656374732c20616e64206469737472696275746520636f64652e20546869732063616e20626520657370656369616c6c792068656c7066756c20666f7220656d6265646465642073797374656d7320646576656c6f706d656e742c207768657265206d616e6167696e6720646570656e64656e6369657320616e64206275696c64696e672070726f6a656374732063616e20626520636f6d706c6963617465642e3c2f703e0d0a093c2f6c693e0d0a3c2f756c3e0d0a0d0a3c703e486f7720746f2067657420737461727465642077697468205275737420666f7220656d6265646465642073797374656d732070726f6772616d6d696e673f3c2f703e0d0a0d0a3c703e546f2067657420737461727465642077697468205275737420666f7220656d6265646465642073797374656d732070726f6772616d6d696e672c20796f75262333393b6c6c206e656564206120666577207468696e67733a3c2f703e0d0a0d0a3c756c3e0d0a093c6c693e0d0a093c703e41205275737420636f6d70696c65723a20596f752063616e20646f776e6c6f616420746865205275737420636f6d70696c65722066726f6d20746865206f6666696369616c205275737420776562736974652e205275737420737570706f7274732061206e756d626572206f6620646966666572656e74206172636869746563747572657320616e64206f7065726174696e672073797374656d732c20736f206d616b65207375726520796f7520646f776e6c6f61642074686520617070726f7072696174652076657273696f6e20666f7220796f7572207461726765742068617264776172652e3c2f703e0d0a093c2f6c693e0d0a093c6c693e0d0a093c703e416e20656d62656464656420646576656c6f706d656e74206b69743a20596f75262333393b6c6c206e65656420616e20656d62656464656420646576656c6f706d656e74206b6974202845444b29207468617420737570706f72747320527573742e20536f6d6520706f70756c6172206f7074696f6e7320696e636c756465207468652053544d333220446973636f7665727920626f6172642c20746865204e6f72646963206e5246353220646576656c6f706d656e74206b69742c20616e64207468652041646166727569742046656174686572204d302e3c2f703e0d0a093c2f6c693e0d0a093c6c693e0d0a093c703e52757374206c696272617269657320666f7220656d62656464656420646576656c6f706d656e743a205468657265206172652061206e756d626572206f662052757374206c696272617269657320617661696c61626c6520666f7220656d62656464656420646576656c6f706d656e742c20696e636c7564696e6720636f727465782d6d2c2077686963682070726f7669646573206c6f772d6c6576656c20737570706f727420666f722041524d20436f727465782d4d206d6963726f636f6e74726f6c6c6572732c20616e6420656d6265646465642d68616c2c2077686963682070726f76696465732061206861726477617265206162737472616374696f6e206c6179657220666f7220636f6d6d6f6e20656d626564646564207065726970686572616c73206c696b65204750494f2070696e7320616e642074696d6572732e3c2f703e0d0a093c2f6c693e0d0a3c2f756c3e0d0a0d0a3c703e4f6e636520796f75206861766520746865736520746f6f6c7320696e20706c6163652c20796f752063616e2073746172742077726974696e67205275737420636f646520666f7220796f757220656d6265646465642073797374656d2e2048657265262333393b7320612073696d706c65206578616d706c65207468617420626c696e6b7320616e204c4544206f6e20616e2053544d333220446973636f7665727920626f6172643a3c2f703e0d0a0d0a3c7072653e0d0a266e6273703b3c2f7072653e0d0a0d0a3c64697620636c6173733d2262672d626c61636b206d622d3420726f756e6465642d6d64223e0d0a3c64697620636c6173733d226f766572666c6f772d792d6175746f20702d34223e3c636f64653e23215b6e6f5f6d61696e5d203c2f636f64653e3c2f6469763e0d0a0d0a3c64697620636c6173733d226f766572666c6f772d792d6175746f20702d34223e3c636f64653e23215b6e6f5f7374645d203c2f636f64653e3c2f6469763e0d0a0d0a3c64697620636c6173733d226f766572666c6f772d792d6175746f20702d34223e3c636f64653e75736520636f727465785f6d5f72743a3a656e7472793b3c2f636f64653e3c2f6469763e0d0a0d0a3c64697620636c6173733d226f766572666c6f772d792d6175746f20702d34223e3c636f64653e7573652073746d3332663378785f68616c3a3a7b7072656c7564653a3a2a2c207061632c2064656c61793a3a44656c61797d3b203c2f636f64653e3c2f6469763e0d0a0d0a3c64697620636c6173733d226f766572666c6f772d792d6175746f20702d34223e3c636f64653e235b656e7472795d203c2f636f64653e3c2f6469763e0d0a0d0a3c64697620636c6173733d226f766572666c6f772d792d6175746f20702d34223e3c636f64653e666e206d61696e2829202d2667743b2021207b3c2f636f64653e3c2f6469763e0d0a0d0a3c64697620636c6173733d226f766572666c6f772d792d6175746f20702d34223e3c636f64653e266e6273703b266e6273703b266e6273703b206c6574206d7574206470203d207061633a3a5065726970686572616c733a3a74616b6528292e756e7772617028293b3c2f636f64653e3c2f6469763e0d0a0d0a3c64697620636c6173733d226f766572666c6f772d792d6175746f20702d34223e3c636f64653e266e6273703b266e6273703b266e6273703b206c6574206d7574206370203d20636f727465785f6d3a3a7065726970686572616c3a3a5065726970686572616c733a3a74616b6528292e756e7772617028293b3c2f636f64653e3c2f6469763e0d0a0d0a3c64697620636c6173733d226f766572666c6f772d792d6175746f20702d34223e3c636f64653e266e6273703b266e6273703b266e6273703b206c6574206d757420726363203d2064702e5243432e636f6e73747261696e28293b203c2f636f64653e3c2f6469763e0d0a0d0a3c64697620636c6173733d226f766572666c6f772d792d6175746f20702d34223e3c636f64653e266e6273703b266e6273703b266e6273703b206c6574206d7574206770696f64203d2064702e4750494f442e73706c69742826616d703b6d7574207263632e616862293b3c2f636f64653e3c2f6469763e0d0a0d0a3c64697620636c6173733d226f766572666c6f772d792d6175746f20702d34223e3c636f64653e266e6273703b266e6273703b266e6273703b206c6574206d7574206c6564203d206770696f642e706431332e696e746f5f707573685f70756c6c5f6f75747075742826616d703b6d7574206770696f642e6d6f6465722c2026616d703b6d7574206770696f642e6f7479706572293b203c2f636f64653e3c2f6469763e0d0a0d0a3c64697620636c6173733d226f766572666c6f772d792d6175746f20702d34223e3c636f64653e266e6273703b266e6273703b266e6273703b206c6574206d75742064656c6179203d2044656c61793a3a6e65772863702e535953542c207263632e636c6f636b73293b3c2f636f64653e3c2f6469763e0d0a0d0a3c64697620636c6173733d226f766572666c6f772d792d6175746f20702d34223e3c636f64653e266e6273703b266e6273703b266e6273703b206c6f6f70207b203c2f636f64653e3c2f6469763e0d0a0d0a3c64697620636c6173733d226f766572666c6f772d792d6175746f20702d34223e3c636f64653e266e6273703b266e6273703b266e6273703b266e6273703b266e6273703b266e6273703b266e6273703b206c65642e7365745f6869676828292e756e7772617028293b3c2f636f64653e3c2f6469763e0d0a0d0a3c64697620636c6173733d226f766572666c6f772d792d6175746f20702d34223e3c636f64653e266e6273703b266e6273703b266e6273703b266e6273703b266e6273703b266e6273703b266e6273703b2064656c61792e64656c61795f6d7328313030305f753136293b3c2f636f64653e3c2f6469763e0d0a0d0a3c64697620636c6173733d226f766572666c6f772d792d6175746f20702d34223e3c636f64653e266e6273703b266e6273703b266e6273703b266e6273703b266e6273703b266e6273703b266e6273703b206c65642e7365745f6c6f7728292e756e7772617028293b3c2f636f64653e3c2f6469763e0d0a0d0a3c64697620636c6173733d226f766572666c6f772d792d6175746f20702d34223e3c636f64653e266e6273703b266e6273703b266e6273703b266e6273703b266e6273703b266e6273703b266e6273703b2064656c61792e64656c61795f6d7328313030305f753136293b3c2f636f64653e3c2f6469763e0d0a0d0a3c64697620636c6173733d226f766572666c6f772d792d6175746f20702d34223e3c636f64653e266e6273703b266e6273703b266e6273703b207d3c2f636f64653e3c2f6469763e0d0a0d0a3c64697620636c6173733d226f766572666c6f772d792d6175746f20702d34223e3c636f64653e7d203c2f636f64653e3c2f6469763e0d0a3c2f6469763e0d0a0d0a3c703e5468697320636f646520757365732074686520636f727465782d6d20616e642073746d3332663378785f68616c206c696272617269657320746f2061636365737320746865204750494f2070696e73206f6e20616e2053544d3c2f703e0d0a0d0a3c703e546869732061727469636c6520776173207772697474656e20627920436861744750542e3c2f703e0d0a3c2f6469763e0d0a, '2023-03-18', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

CREATE TABLE `Comments` (
  `comment_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT -1,
  `username` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `submit_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Followers`
--

CREATE TABLE `Followers` (
  `follow_id` int(1) NOT NULL DEFAULT 0,
  `follower_id` int(11) NOT NULL,
  `followed_id` int(11) NOT NULL,
  `follower_username` varchar(50) NOT NULL,
  `followed_username` varchar(50) NOT NULL,
  `unique_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `SavedArticles`
--

CREATE TABLE `SavedArticles` (
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `saved_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `SavedArticles`
--

INSERT INTO `SavedArticles` (`article_id`, `user_id`, `saved_date`) VALUES
(1, 3, '2023-03-17'),
(2, 1, '2023-03-18'),
(2, 2, '2023-03-17'),
(2, 3, '2023-03-17'),
(4, 4, '2023-03-18');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 0,
  `reader` tinyint(1) NOT NULL DEFAULT 1,
  `writer` tinyint(1) NOT NULL DEFAULT 0,
  `designer` tinyint(1) NOT NULL DEFAULT 0,
  `advertiser` tinyint(1) NOT NULL DEFAULT 0,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`user_id`, `username`, `first_name`, `last_name`, `email`, `password`, `approved`, `reader`, `writer`, `designer`, `advertiser`, `admin`) VALUES
(1, 'chad_flemmington', 'Chad', 'Flemmington', 'chad.flemmington@gmail.com', '7494dc318aa9772ec3fe1c507c4e2be5', 1, 1, 1, 1, 1, 1),
(2, 'rodrick_henry', 'Rodrick', 'Henry', 'rodrick.henry@gmail.com', 'bb795fe9516be8a6b6e91f1e68ec68fa', 1, 1, 1, 1, 0, 0),
(3, 'chii_robinson', 'Chii', 'Robinson', 'chii.robinson@gmail.com', 'fcb98ce75506ba63e4476a57998810c9', 1, 1, 1, 1, 1, 1),
(4, 'rebecca_ross', 'Rebecca', 'Ross', 'rebecca.ross@gmail.com', 'a25d40c2e2be71e10fe7778758a28029', 1, 1, 1, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Ads`
--
ALTER TABLE `Ads`
  ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `Articles`
--
ALTER TABLE `Articles`
  ADD PRIMARY KEY (`article_id`);

--
-- Indexes for table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `Followers`
--
ALTER TABLE `Followers`
  ADD PRIMARY KEY (`follower_username`,`followed_username`),
  ADD KEY `unique_number` (`unique_id`);

--
-- Indexes for table `SavedArticles`
--
ALTER TABLE `SavedArticles`
  ADD PRIMARY KEY (`article_id`,`user_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Ads`
--
ALTER TABLE `Ads`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Articles`
--
ALTER TABLE `Articles`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Followers`
--
ALTER TABLE `Followers`
  MODIFY `unique_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=551;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
