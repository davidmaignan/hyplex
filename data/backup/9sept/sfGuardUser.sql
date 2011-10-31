INSERT INTO `sf_guard_user` VALUES(35, 'Test', 'Testing', 'test2@hypertech.com', 'Test', 'sha1', '3e7503122137cca199cb62672921677a', '81d5e5fc19ac74ab7184411e0fb4b233d2616d78', 1, 0, NULL, '2011-10-23 15:44:27', '2011-10-23 20:23:42');
INSERT INTO `sf_guard_user` VALUES(48, 'Teston', 'Testage', 'test3@hypertech.com', 'test3@hypertech.com', 'sha1', '0bfa17b76a8f418e80d4c76e9414f639', '99bcd259e5341d08d91f4850697a45e06b3d709a', 1, 0, NULL, '2011-10-23 15:58:03', '2011-10-23 20:24:01');
INSERT INTO `sf_guard_user` VALUES(69, 'Tomi', 'Klemm', 'tomi.klemm@gmail.com', 'tomkle', 'sha1', '062e7322725241743a644e5c58a0cb12', 'f74b609f913e9fd0a5f83eceabe7de9cb714f542', 1, 0, '2011-10-31 09:56:05', '2011-10-23 20:33:10', '2011-10-31 09:56:05');
INSERT INTO `sf_guard_user` VALUES(70, 'David', 'Maignan', 'davidmaignan@gmail.com', 'davmai', 'sha1', '579e04bff50587a2201966f0fdb2fd48', '3826bcf5c46064d181f8c10dbf62d03906c465e0', 1, 0, '2011-10-31 10:00:49', '2011-10-23 21:38:28', '2011-10-31 10:00:49');
INSERT INTO `sf_guard_user` VALUES(71, NULL, NULL, 'test@hypertech.com', 'test@hypertech.com', 'sha1', '9667951828b5a818d3fb23dc5915f8e8', '60389b9d2d3959625a00ae31abdc8b0d8eea71f2', 1, 0, NULL, '2011-10-25 13:18:32', '2011-10-25 13:18:32');
INSERT INTO `sf_guard_user` VALUES(73, NULL, NULL, 'tomi@hypertech.com', 'tomi@hypertech.com', 'sha1', 'a5f6288aea757795f4d32e81ae406900', '7f723b9f92e86e16559ac140918ec317ba136fe7', 1, 0, NULL, '2011-10-26 22:21:11', '2011-10-26 22:21:11');

INSERT INTO `sf_guard_group` VALUES(6, 'sales', '', '2011-10-23 22:12:55', '2011-10-23 22:12:55');
INSERT INTO `sf_guard_group` VALUES(7, 'manager', '', '2011-10-23 22:13:09', '2011-10-23 22:13:09');
INSERT INTO `sf_guard_group` VALUES(8, 'customer', '', '2011-10-23 22:13:27', '2011-10-23 22:13:27');
INSERT INTO `sf_guard_group` VALUES(9, 'writer', '', '2011-10-23 22:23:47', '2011-10-24 00:27:34');
INSERT INTO `sf_guard_group` VALUES(10, 'IT', '', '2011-10-24 00:27:10', '2011-10-24 00:27:10');
INSERT INTO `sf_guard_group` VALUES(11, 'editor', '', '2011-10-24 00:27:45', '2011-10-24 00:27:45');

INSERT INTO `sf_guard_permission` VALUES(4, 'admin', '', '2011-10-23 22:12:23', '2011-10-23 22:12:23');
INSERT INTO `sf_guard_permission` VALUES(5, 'demo', '', '2011-10-23 22:12:29', '2011-10-23 22:12:29');
INSERT INTO `sf_guard_permission` VALUES(6, 'writer', '', '2011-10-24 00:38:26', '2011-10-24 00:38:26');
INSERT INTO `sf_guard_permission` VALUES(7, 'editor', '', '2011-10-24 00:38:39', '2011-10-24 00:38:39');
INSERT INTO `sf_guard_permission` VALUES(8, 'customer', '', '2011-10-24 10:36:23', '2011-10-24 10:36:23');

INSERT INTO `sf_guard_group_permission` VALUES(6, 5, '2011-10-23 22:12:55', '2011-10-23 22:12:55');
INSERT INTO `sf_guard_group_permission` VALUES(7, 5, '2011-10-23 22:13:09', '2011-10-23 22:13:09');
INSERT INTO `sf_guard_group_permission` VALUES(8, 8, '2011-10-24 10:36:23', '2011-10-24 10:36:23');
INSERT INTO `sf_guard_group_permission` VALUES(9, 6, '2011-10-24 00:38:26', '2011-10-24 00:38:26');
INSERT INTO `sf_guard_group_permission` VALUES(11, 6, '2011-10-24 00:38:26', '2011-10-24 00:38:26');
INSERT INTO `sf_guard_group_permission` VALUES(11, 7, '2011-10-24 00:38:39', '2011-10-24 00:38:39');

INSERT INTO `sf_guard_user_group` VALUES(69, 7, '2011-10-23 22:13:14', '2011-10-23 22:13:14');

INSERT INTO `sf_guard_user_permission` VALUES(35, 8, '2011-10-24 10:36:23', '2011-10-24 10:36:23');
INSERT INTO `sf_guard_user_permission` VALUES(48, 8, '2011-10-24 10:36:23', '2011-10-24 10:36:23');
INSERT INTO `sf_guard_user_permission` VALUES(70, 4, '2011-10-23 23:00:02', '2011-10-23 23:00:02');