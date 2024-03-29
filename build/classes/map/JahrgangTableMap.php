<?php



/**
 * This class defines the structure of the 'jahrgang' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator..map
 */
class JahrgangTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.map.JahrgangTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('jahrgang');
        $this->setPhpName('Jahrgang');
        $this->setClassname('Jahrgang');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('jbez', 'Jbez', 'VARCHAR', true, 6, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Raum', 'Raum', RelationMap::ONE_TO_MANY, array('jbez' => 'jbez', ), null, null, 'Raums');
    } // buildRelations()

} // JahrgangTableMap
