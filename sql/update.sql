ALTER TABLE  `pours` ADD  `pinId` INT( 11 ) NULL AFTER  `tapId`;
ALTER TABLE  `taps` ADD  `pinId` INT( 11 ) NULL AFTER  `tapNumber`;
INSERT INTO `config` (`configName`, `configValue`, `displayName`, `showOnPanel`) VALUES ('useFlowMeter', '0', 'Use Flow Monitoring', '1');
ALTER TABLE `pours` CHANGE `amountPoured` `amountPoured` FLOAT( 6, 3 ) NOT NULL;
ALTER TABLE  `pours` ADD  `pulses` INT( 6 ) NOT NULL AFTER  `amountPoured`;
INSERT INTO `config` (`configName`, `configValue`, `displayName`) VALUES ('skin-FrontEnd', 'RPints-Veritcal', 'Tap Listing Skin');