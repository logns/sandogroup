<?php
require_once JPATH_COMPONENT.DS.'views/listing/tmpl/helpers/filter/projectsearchform.class.php';
echo ProjectSearchForm::getPriceOption('25','25 Lac','maxprice');
echo ProjectSearchForm::getPriceOption('40','40 Lac','maxprice');
echo ProjectSearchForm::getPriceOption('60','60 Lac','maxprice');
echo ProjectSearchForm::getPriceOption('90','90 Lac','maxprice');
echo ProjectSearchForm::getPriceOption('120','1.2 Cr','maxprice');
echo ProjectSearchForm::getPriceOption('150','1.5 Cr','maxprice');
echo ProjectSearchForm::getPriceOption('200','2.0 Cr','maxprice');
echo ProjectSearchForm::getPriceOption('250','2.5 Cr','maxprice');
echo ProjectSearchForm::getPriceOption('300','3.0 Cr','maxprice');
echo ProjectSearchForm::getPriceOption('350','3.5 Cr','maxprice');
echo ProjectSearchForm::getPriceOption('400','4.0 Cr','maxprice');
echo ProjectSearchForm::getPriceOption('450','4.5 Cr','maxprice');
echo ProjectSearchForm::getPriceOption('500','5.0 Cr','maxprice');
echo ProjectSearchForm::getPriceOption('550','5.5 Cr','maxprice');
echo ProjectSearchForm::getPriceOption('600','6.0 Cr','maxprice');
echo ProjectSearchForm::getPriceOption('650','6.5 Cr','maxprice');
echo ProjectSearchForm::getPriceOption('700','7.0 Cr','maxprice');
echo ProjectSearchForm::getPriceOption('800','8.0 Cr','maxprice');
echo ProjectSearchForm::getPriceOption('500000','>8.0 Cr','maxprice', !isset($_REQUEST[maxprice]));
?>