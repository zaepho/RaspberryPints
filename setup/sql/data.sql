# This data is part of the default $steps array to help you
# illustrate how this script works. Feel free to delete it.
# Note that each SQL statement ends if a semi-column!

CREATE TABLE `{:db_prefix}table` (
  `name` varchar(40) NOT NULL DEFAULT '',
  `val` text NOT NULL
) ENGINE={:db_engine} DEFAULT CHARSET={:db_charset};

INSERT INTO `{:db_prefix}table`(`name`,`val`) VALUES ('some_value', 'Some value');
INSERT INTO `{:db_prefix}table`(`name`,`val`) VALUES ('website_url', '{:website}');
