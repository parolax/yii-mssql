<?php

class FullDemandsAR extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'FullDemands';
	}

	/** Преобразует все типы данных разделяющих пробелом дату и время, в формат для MSSQL с разделителем 'T'. На сегодня таких типов 4: 'datetime', 'smalldatetime', 'datetime2', и 'datetimeoffset' */
	public function beforeSave()
	{
		parent::beforeSave();

		foreach ($this->getMetaData()->columns as $attribute => $column) {
			$dbType = strtolower($column->dbType);

			if (strpos($dbType, 'datetime') !== false) {
				$this->$attribute = $this->datetimeToSql($this->$attribute);
			}
		}

		return true;
	}
}
