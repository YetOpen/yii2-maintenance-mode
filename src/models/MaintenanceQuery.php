<?php

namespace brussens\maintenance\models;


use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Maintenance]].
 *
 * @see Maintenance
 */
class MaintenanceQuery extends ActiveQuery
{
    /**
     * @return MaintenanceQuery
     */
    public function active()
    {
        return $this->andWhere(['and',
            ['date' => date('Y-m-d')],
            ['<=', 'time_start', date('H:i:s')],
            ['>=', 'time_end', date('H:i:s')],
        ]);
    }

    /**
     * @return MaintenanceQuery
     */
    public function future()
    {
        return $this->andWhere(['and',
            ['>=', 'date', date('Y-m-d')],
            ['>=', 'time_start', date('H:i:s')],
        ]);
    }

    /**
     * {@inheritdoc}
     * @return Maintenance[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Maintenance|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
