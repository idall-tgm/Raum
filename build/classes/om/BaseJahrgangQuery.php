<?php


/**
 * Base class that represents a query for the 'jahrgang' table.
 *
 *
 *
 * @method JahrgangQuery orderByJbez($order = Criteria::ASC) Order by the jbez column
 *
 * @method JahrgangQuery groupByJbez() Group by the jbez column
 *
 * @method JahrgangQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method JahrgangQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method JahrgangQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method JahrgangQuery leftJoinRaum($relationAlias = null) Adds a LEFT JOIN clause to the query using the Raum relation
 * @method JahrgangQuery rightJoinRaum($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Raum relation
 * @method JahrgangQuery innerJoinRaum($relationAlias = null) Adds a INNER JOIN clause to the query using the Raum relation
 *
 * @method Jahrgang findOne(PropelPDO $con = null) Return the first Jahrgang matching the query
 * @method Jahrgang findOneOrCreate(PropelPDO $con = null) Return the first Jahrgang matching the query, or a new Jahrgang object populated from the query conditions when no match is found
 *
 *
 * @method array findByJbez(string $jbez) Return Jahrgang objects filtered by the jbez column
 *
 * @package    propel.generator..om
 */
abstract class BaseJahrgangQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseJahrgangQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = null, $modelName = null, $modelAlias = null)
    {
        if (null === $dbName) {
            $dbName = 'Raum';
        }
        if (null === $modelName) {
            $modelName = 'Jahrgang';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new JahrgangQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   JahrgangQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return JahrgangQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof JahrgangQuery) {
            return $criteria;
        }
        $query = new JahrgangQuery(null, null, $modelAlias);

        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Jahrgang|Jahrgang[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = JahrgangPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(JahrgangPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Jahrgang A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByJbez($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Jahrgang A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `jbez` FROM `jahrgang` WHERE `jbez` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Jahrgang();
            $obj->hydrate($row);
            JahrgangPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return Jahrgang|Jahrgang[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Jahrgang[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return JahrgangQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(JahrgangPeer::JBEZ, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return JahrgangQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(JahrgangPeer::JBEZ, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the jbez column
     *
     * Example usage:
     * <code>
     * $query->filterByJbez('fooValue');   // WHERE jbez = 'fooValue'
     * $query->filterByJbez('%fooValue%'); // WHERE jbez LIKE '%fooValue%'
     * </code>
     *
     * @param     string $jbez The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return JahrgangQuery The current query, for fluid interface
     */
    public function filterByJbez($jbez = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($jbez)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $jbez)) {
                $jbez = str_replace('*', '%', $jbez);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(JahrgangPeer::JBEZ, $jbez, $comparison);
    }

    /**
     * Filter the query by a related Raum object
     *
     * @param   Raum|PropelObjectCollection $raum  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 JahrgangQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByRaum($raum, $comparison = null)
    {
        if ($raum instanceof Raum) {
            return $this
                ->addUsingAlias(JahrgangPeer::JBEZ, $raum->getJbez(), $comparison);
        } elseif ($raum instanceof PropelObjectCollection) {
            return $this
                ->useRaumQuery()
                ->filterByPrimaryKeys($raum->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRaum() only accepts arguments of type Raum or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Raum relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return JahrgangQuery The current query, for fluid interface
     */
    public function joinRaum($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Raum');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Raum');
        }

        return $this;
    }

    /**
     * Use the Raum relation Raum object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   RaumQuery A secondary query class using the current class as primary query
     */
    public function useRaumQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRaum($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Raum', 'RaumQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Jahrgang $jahrgang Object to remove from the list of results
     *
     * @return JahrgangQuery The current query, for fluid interface
     */
    public function prune($jahrgang = null)
    {
        if ($jahrgang) {
            $this->addUsingAlias(JahrgangPeer::JBEZ, $jahrgang->getJbez(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
