-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.7.14


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema sysventascrm
--

CREATE DATABASE IF NOT EXISTS sysventascrm;
USE sysventascrm;

--
-- Definition of table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente` (
  `Codigo_Cliente` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Apellido` varchar(100) DEFAULT NULL,
  `Profesion` varchar(45) DEFAULT NULL,
  `Direccion` varchar(200) DEFAULT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `Observacion` varchar(200) DEFAULT NULL,
  `Fecha_Creado` datetime DEFAULT NULL,
  `Fecha_Modificado` datetime DEFAULT NULL,
  `Fecha_Eliminado` datetime DEFAULT NULL,
  `Usuario_Creado` datetime DEFAULT NULL,
  `Usuario_Modificado` datetime DEFAULT NULL,
  `Usuario_Eliminado` datetime DEFAULT NULL,
  `Estado` char(1) DEFAULT NULL,
  `Codigo_Opc` int(11) NOT NULL,
  `Codigo_Tlmk` int(11) NOT NULL,
  PRIMARY KEY (`Codigo_Cliente`),
  KEY `fk_cliente_folio_idx` (`Codigo_Opc`),
  KEY `fk_cliente_folio1_idx` (`Codigo_Tlmk`),
  CONSTRAINT `fk_cliente_folio` FOREIGN KEY (`Codigo_Opc`) REFERENCES `folio` (`Codigo_Folio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cliente_folio1` FOREIGN KEY (`Codigo_Tlmk`) REFERENCES `folio` (`Codigo_Folio`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cliente`
--

/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;


--
-- Definition of table `folio`
--

DROP TABLE IF EXISTS `folio`;
CREATE TABLE `folio` (
  `Codigo_Folio` int(11) NOT NULL,
  `Valor` varchar(100) DEFAULT NULL,
  `Descripcion` varchar(200) DEFAULT NULL,
  `Estado` char(1) DEFAULT NULL,
  `Fecha_Modificada` datetime DEFAULT NULL,
  `Usuario_Modificado` datetime DEFAULT NULL,
  PRIMARY KEY (`Codigo_Folio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `folio`
--

/*!40000 ALTER TABLE `folio` DISABLE KEYS */;
/*!40000 ALTER TABLE `folio` ENABLE KEYS */;


--
-- Definition of table `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE `rol` (
  `Cod_Rol` int(11) NOT NULL,
  `Descripcion` varchar(45) DEFAULT NULL,
  `Fecha_Creada` datetime DEFAULT NULL,
  `Fecha_Modificada` datetime DEFAULT NULL,
  `Fecha_Eliminada` datetime DEFAULT NULL,
  `Estado` char(1) DEFAULT NULL,
  PRIMARY KEY (`Cod_Rol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rol`
--

/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` (`Cod_Rol`,`Descripcion`,`Fecha_Creada`,`Fecha_Modificada`,`Fecha_Eliminada`,`Estado`) VALUES 
 (1,'Anfitrión',NULL,NULL,NULL,'1'),
 (2,'Supervisor',NULL,NULL,NULL,'1'),
 (3,'Digitador',NULL,NULL,NULL,'1'),
 (4,'Director de mercadeo',NULL,NULL,NULL,'1'),
 (5,'Telemarketing',NULL,NULL,NULL,'1'),
 (6,'Confirmador',NULL,NULL,NULL,'1'),
 (7,'Supervisora de telemarketing',NULL,NULL,NULL,'1'),
 (8,'No access liner',NULL,NULL,NULL,'1'),
 (9,'No access closer',NULL,NULL,NULL,'1'),
 (10,'Jefe de contratos',NULL,NULL,NULL,'1'),
 (11,'Jefe de sala',NULL,NULL,NULL,'1'),
 (12,'Jefe de ventas',NULL,NULL,NULL,'1'),
 (13,'Director de proyecto',NULL,NULL,NULL,'1'),
 (14,'Gerente General',NULL,NULL,NULL,'1');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;


--
-- Definition of table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `Codigo_Usuario` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Apellido` varchar(45) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `Contrasena` varchar(250) DEFAULT NULL,
  `AuthKey` varchar(250) DEFAULT NULL,
  `AccessToken` varchar(250) DEFAULT NULL,
  `Activate` tinyint(1) NOT NULL DEFAULT '0',
  `Fecha_Creado` datetime DEFAULT NULL,
  `Fecha_Modificada` datetime DEFAULT NULL,
  `Fecha_Eliminada` datetime DEFAULT NULL,
  `Usuario_Creado` varchar(250) DEFAULT NULL,
  `Usuario_Modificado` varchar(250) DEFAULT NULL,
  `Usuario_Eliminado` varchar(250) DEFAULT NULL,
  `Ultima_Sesion` datetime DEFAULT NULL,
  `Estado` char(1) DEFAULT NULL,
  `Codigo_Rol` int(11) NOT NULL,
  PRIMARY KEY (`Codigo_Usuario`),
  KEY `fk_Usuario_Roles_idx` (`Codigo_Rol`),
  CONSTRAINT `fk_Usuario_Roles` FOREIGN KEY (`Codigo_Rol`) REFERENCES `rol` (`Cod_Rol`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`Codigo_Usuario`,`Nombre`,`Apellido`,`Email`,`Contrasena`,`AuthKey`,`AccessToken`,`Activate`,`Fecha_Creado`,`Fecha_Modificada`,`Fecha_Eliminada`,`Usuario_Creado`,`Usuario_Modificado`,`Usuario_Eliminado`,`Ultima_Sesion`,`Estado`,`Codigo_Rol`) VALUES 
 (5,'Henry Pablo','Ayala','hp.vega@hotmail.com','000000','b44c3456c1e8c017f38dc04f07f70faa99e23bd4951a1eb8975b75047a500d62ece680c0b7aacab8998679174c1768999d39420a38a7d415f80feb988b3c212dacf953a226f34dd1b6f6aa6718ce48101817d1b862ad13fac24cd89404afcd60d383ae1c','0db547724cef543f5deea01f0c6ee9ee052ad95724f04d28148be12b93a6710e7bfec99b6a6f858f2a858096883c789c3030173c0e2c3a349dee8d6edb30dc7852c0c33cff584e477fb5e9957c938fb2e2bddd895fe1a0c8aed9a2298a43a06ac1094545',0,'2017-01-22 01:29:38','2017-01-22 06:14:21',NULL,NULL,'hp.veg2a@hotmail.com',NULL,NULL,'1',1),
 (6,'1','1','hp.veg2a@hotmail.com','00000000','afffb8c8a25b2327572715cc7a0f5b53c6c0a0b90726b089f9db689f49be53a8d2786d7f41c733c161769059fe4241e3b506012c614e9cefcff7aff88acc15f48e698abe68bbdbe3f35ea36efb1ccfeb2db3ea1644fee0dd1c9a7ec942524fb8b2e33f65','0618eb9c0cbd2efa706eb56b1cf85b89ae27cc32e2b6b512835101f46de45d942d0c73be9e84321f7c39336384b6348481d71010304984e34be73bb7916d024bcb789358a7e4bdacf17b29e274eba5f7ecfffc760564cb3b8cf5fdf34c5f2f79e26d2c7a',0,'2017-01-21 11:01:52','2017-01-22 05:28:52','2017-01-22 05:54:59',NULL,'hp.veg2a@hotmail.com','hp.veg2a@hotmail.com',NULL,'1',2),
 (7,'Henry Pablo','Ayala','ing@hotmail.com','000000','b35db61e3c49db41d02ef0327897ffaeb260775f6a6641044a342b661196c04388690d777d588d9d8b1f2d719f8b87cf44477a646620bf0cb2e10451f3462531d60ccc4836eec751bf99c2283df7a8795da705f1eb72b58ba22675c45e7ff197ab271391','76ec799c6a9aff5754dc309bef8e0816e74d238319e45ecf302f5575f9bbd2613f73b3509e13940de3484035f9dd93a36c8f2a030919bf328b4721dbced629ba7f8166ac4a05c14c093ce8578ab596b86959981b70d6a92d6ef885b91c79e99b3807a060',0,'2017-01-21 11:45:40','2017-01-22 04:53:16','2017-01-22 05:25:08',NULL,NULL,'hp.veg2a@hotmail.com',NULL,'1',3),
 (8,'Amy','D. Myhre','ings@hotmail.com','000000','76d2236beec6e5ccede0143a3f1c7d8091f7cb7acf6ccab57307272c8ba5cd7b9301495f76e87694e0f51104ad14e44d7af2ad1b134a185842d8e0b2b669e1e548b8e8cc968280f37b919547a494d473ec640843ffafde748a2120c178a59de665e70eb0','2ea311da7ea69211129c4b30c55febf3438d2b1759f2e947a278c0600aaead1c4e4d2b3a09331663182b3b7536c2452c1fe3f122905b2a5564b47c6137dcc401d67fbd010c48132e8623a3231fbd28cc73d14ec66f2be2ec9e78afdadc83627df619c660',0,'2017-01-22 12:05:30',NULL,'2017-01-22 05:55:11',NULL,NULL,'hp.veg2a@hotmail.com',NULL,'1',4),
 (9,'Henry Pablo','Ayala','hp.vega@hotmail.com','fsqScjqzw.euI','7c663bd53e96b4c153c958a678baf01f77263ae8ffd7e2eec98cc2bca3ee991e48cb00e185fff5d005150397a5f917030f47cccff2eceea837843a698cd97bceadb95e8444c0be664fd937114aa0b57f20f1d52f8d7963fa3d032aaefd4cd6f7791f23af','9b19fe64f114e21277dfdc54b8136706809e6fc5ab0b916cd647b8a7ddfd71335ae9b7fb3bd8169b1c856bc0c8bd71551b2be407a28b819137ba03cfa953465ea132f709ee24c28d49c481b460df023d1e30e1d11093f85e21a5e6700d3194f16113b08f',0,'2017-01-22 12:38:29',NULL,'2017-01-22 05:55:13',NULL,NULL,'hp.veg2a@hotmail.com',NULL,'1',5),
 (10,'Henry Pablo','Ayala','hp.vega@hotmail.com','000000','edafa31ab207da11725d5b56eb4ff2a4d7986ab6f313614a0b7db12adb7327031fef70b1928e56e002fb865c2914cbd0c4a4e31a9f5698e456e7a8fbd514cd0bc8b7b4d0fa8d4936192128e9ef712d853938f405b30158f729d91735573deb7cf9078188','dbf4c515a8df53ef2d56f7c127447c69504490817533fdf651dd7164b2dfd6a733f2b96bbf05066ce4b358769cc88d44740f40a458256c40d4f69ee5e32f924f1379343a4eb32071229832a289d316b81042873ea39f4301de9724dd9df6e77e7b783890',0,'2017-01-22 01:38:20',NULL,'2017-01-22 04:35:53',NULL,NULL,NULL,NULL,'1',6),
 (11,'Henry Pablo','Ayala','hp.vega@hotmail.com','000000','e9d9ab6d0632f1cff070ecfc557036b1f1edaeb99e73edd0fbffd1b3d13c152dfed676eb1daabfb8eb539c5033cdda70d2a524f362a76675b19d3dc37b3574a98b5bc8d19d89f4195ebec42ca993e5c72ae632a5ae5268a3e0b4226badc74cbc9057825f','95f1a1024990657087e18886fb9fc9ef6286d14897529e7b47d0ab373dccd54515e1e763ccfb9d5dedb6a4dd44dfd791ae31d265c67972146962824a41c8afc31d58a45cb6dd4da1ca04479c15985ddb72655c1a7d18ef24027cd2c5de4df1b9ad48e9bd',0,'2017-01-22 01:52:26',NULL,'2017-01-22 04:35:33',NULL,NULL,NULL,NULL,'1',7),
 (12,'Henry Pablo','Ayala','hp.vega000@hotmail.com','000000','ebd42a52cdbebdae6d7ed5c487ef5d83e8cd02843cd58f855dd2a061e98112d5bc9cb08c80e23653141c41e421f8bd0e7542447abbc5b4f6c03dc84d4f563d1c04ddce4ecc9d28704233367d438a94018a4e1ee8c33c71dfbb1f79922da4d1ebe5964578','90c1a12509d2929dfd94f39c17c361ee432cb7402e7aa17e9379ec223ed6533adc7ca24238f886251f25cb9f2cc03b5c4b937429295c42c271c78ff10f9fe96590901cf7ef97f345b93f2a2ac8447e53cb83aa9b9bb77aaed68dab3958dff827dc4c1d14',0,'2017-01-22 01:57:04',NULL,NULL,NULL,NULL,NULL,NULL,'1',8),
 (13,'Henry Pablo','Ayala','hp.vega@hotmail.com','000000','d8c0998a0a8859e43c0efff2390f4650cd460adaa48ff83d9b77db355ee9609da7a15201345c8d6de1c59e5e59b950bf58d38f2daa0fe8730cea366d3a5f35a8eefa921ff698386e0ef4b442e1dbe1875be88cf718075f30e5e5180e8e3d834bbdcb5ba5','215c5cd8b3ab53bf0175fbe6e684003a1f874f66575773366a924967f5149bb4e39808d9d0da79a399968ccde9990d048d8fb623304256e6be70960ac4e5543a1d6b3b537591180fb930962d74268156831ea668a1b5b01f8ad66c150b4e9548dfa7e754',0,'2017-01-22 01:58:07',NULL,NULL,NULL,NULL,NULL,NULL,'1',9),
 (14,'Henry Pablo','Ayala','hp.vega@hotmail.com','000000','47fb0268b9a0efe08cdd02c46b6d28e333fc0ce69f676b9b6b5900be439f970a04e4fd4b6af4cd3d1facd38df297ec16bca1b3850b7705a5bad49d32868527f94a4560a582d023033be33cce005938c2adcef2acff1f273792e7a23f50032f61f72e5a88','32241150deb20d869683fcf62773a94a5c2fd040f1623eb4a2f9af503c9fcde26b007626faf956c7954538a12891d86140b7f2d2c87653b07d77a7c8fa78c8c51b5454748dc8278f2b7ffbd5a1468f0fbcd79ceb28f1e035bf6d26b82fe93b203330ba49',0,'2017-01-22 01:58:24',NULL,NULL,NULL,NULL,NULL,NULL,'1',10),
 (15,'Henry Pablo','Ayala','hp.vega111@hotmail.com','000000','d64c7ba1be8202fd7fd7683ed5e738208a9f4e706d8a570927942e78766a709825c70825f17892ecb538db98fdc39ef6a6d6a7b17b4ca3b518b16d9f6a02922a0dda1d22cbf69a546211c57bad178c4349a57879017667e99266143dc7124b336c55a9a7','1dec1a43a78238d5d6f3e11965ecc1ba0038a39493844354bbaa6dc53369cea3e86a12bb656b33b88647cf67f8bb9272966266c81c39faf227ca07de93e45b282a5091ab9adca613ae23253c13f2eab3a424a2730e5628191c5329607ae76024f4cea912',0,'2017-01-22 01:59:57',NULL,NULL,NULL,NULL,NULL,NULL,'1',11),
 (16,'Henry Pablo','Ayala','hp.vega2@hotmail.com','000000','0146c87019c3c99116e4a52dc55619f0d0f4c0c4267a9758508528653cf142b98688beff09f83a04710c81839a71504811028200d16cb486777ab187ced845ce82522c0770b513ff53bdd661e8152f29da89bcd405e5694d16d6d131d837d05b07a52287','60fb8462bee5b2d7bd2066721a977e10b0e6867c3cca6953690fd360047f908fd7b86d6d908606b50bc33543d32da9d4d4503b23db3789fd736e6e0c88b2970fc7eedfdffbbee21ac1ef7d9c133c6b1080515852f12b111e04456111858c05073eabb8ca',0,'2017-01-22 02:33:41',NULL,'2017-01-22 05:55:17',NULL,NULL,'hp.veg2a@hotmail.com',NULL,'1',12),
 (17,'Henry Pablo','Ayala','hp.vega9@hotmail.com','000000','43f01bd02f6c352479f3a16afc632d7f647774fe8dec43b3047d757bc4d7a7f16ae5a4f2b143383975cd1f726320066a4628c9dcdb801294cdf4af4ff8505cb80941c4accba2c3c6fa1015f2536677dda150a542a09b59ed0d02618ba35179e72f355cce','5c7ac6dbf7ea83faca2350d883f1f920fe3e28bec6989c4fc7cb2e9ecea27c6866d951777b2d8a7aba59c24aee29d585b45a600706a75e8b73cc4bcde4960489f7b0548c78f7f8722116ab35c1d9296301fd3fd8cf2d885ea646e08483f224230110ef19',0,'2017-01-22 02:36:14',NULL,'2017-01-22 05:55:08',NULL,NULL,'hp.veg2a@hotmail.com',NULL,'1',13),
 (18,'Henry Vega','123','123@gmail.com','000000','a6e703b3272ea7a9d04d5a6c7000d89ab024ee0f7e543785557d9fbb3229d35ab0479e40ab70ad38c082cbdfda39a4f0863f2568bf62f9c1017ecce9591e6b8c421e9155a83b1b303830a4cabdd908eed3d3f43877f9238534e76190f78a8b265b7d2cf2','2c8d11b02775154d1701d444a9fe3b81b8f7e5c1e0e99ecf1e6e1348ed552f0729578fb89f32fe38fab23822f791fa52708d1f8514623476bcdb33e2f6a4bb93aeaa85488e786faa55da0487ccad41bbb19cc1d1cf5361b5d3cfcb03888bbea8aa64f340',0,'2017-01-22 02:35:49',NULL,'2017-01-22 05:55:04',NULL,NULL,'hp.veg2a@hotmail.com',NULL,'1',14);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
