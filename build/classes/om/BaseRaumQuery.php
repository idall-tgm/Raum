<?php


/**
 * Base class that represents a query for the 'raum' table.
 *
 *
 *
 * @method RaumQuery orderByRnr($order = Criteria::ASC) Order by the rnr column
 * @method RaumQuery orderByHatbeamer($order = Criteria::ASC) Order by the hatbeamer column
 * @method RaumQuery orderByJbez($order = Criteria::ASC) Order by the jbez column
 *
 * @method RaumQuery groupByRnr() Group by the rnr column
 * @method RaumQuery groupByHatbeamer() Group by the hatbeamer column
 * @method RaumQuery groupByJbez() Group by the jbez column
 *
 * @method RaumQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method RaumQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method RaumQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method RaumQuery leftJoinJahrgang($relationAlias = null) Adds a LEFT JOIN clause to the query using the Jahrgang relation
 * @method RaumQuery rightJoinJahrgang($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Jahrgang relation
 * @method RaumQuery innerJoinJahrgang($relationAlias = null) Adds a INNER JOIN clause to the query using the Jahrgang relation
 *
 * @method Raum findOne(PropelPDO $con = null) Return the first Raum matching the query
 * @method Raum findOneOrCreate(PropelPDO $con = null) Return the first Raum matching the query, or a new Raum object populated from the query conditions when no match is found
 *
 * @method Raum findOneByHatbeamer(boolean $hatbeamer) Return the first Raum filtered by the hatbeamer column
 * @method Raum findOneByJbez(string $jbez) Return the first Raum filtered by the jbez column
 *
 * @method array findByRnr(string $rnr) Return Raum objects filtered by the rnr column
 * @method array findByHatbeamer(boolean $hatbeamer) Return Raum objects filtered by the hatbeamer column
 * @method array findByJbez(string $jbez) Return Raum objects filtered by the jbez column
 *
 * @package    propel.generator..om
 */
abstract class BaseRaumQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseRaumQuery object.
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
            $modelName = 'Raum';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new RaumQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   RaumQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return RaumQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof RaumQuery) {
            return $criteria;
        }
        $query = new RaumQuery(null, null, $modelAlias);

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
     * @return   Raum|Raum[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = RaumPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(RaumPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Raum A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByRnr($key, $con = null)
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
     * @return                 Raum A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `rnr`, `hatbeamer`, `jbez` FROM `raum` WHERE `rnr` = :p0';
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
            $obj = new Raum();
            $obj->hydrate($row);
            RaumPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Raum|Raum[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Raum[]|mixed the list of results, formatted by the current formatter
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
     * @return RaumQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RaumPeer::RNR, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return RaumQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RaumPeer::RNR, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the rnr column
     *
     * Example usage:
     * <code>
     * $query->filterByRnr('fooValue');   // WHERE rnr = 'fooValue'
     * $query->filterByRnr('%fooValue%'); // WHERE rnr LIKE '%fooValue%'
     * </code>
     *
     * @param     string $rnr The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RaumQuery The current query, for fluid interface
     */
    public function filterByRnr($rnr = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rnr)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $rnr)) {
                $rnr = str_replace('*', '%', $rnr);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RaumPeer::RNR, $rnr, $comparison);
    }

    /**
     * Filter the query on the hatbeamer column
     *
     * Example usage:
     * <code>
     * $query->filterByHatbeamer(true); // WHERE hatbeamer = true
     * $query->filterByHatbeamer('yes'); // WHERE hatbeamer = true
     * </code>
     *
     * @param     boolean|string $hatbeamer The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RaumQuery The current query, for fluid interface
     */
    public function filterByHatbeamer($hatbeamer = null, $comparison = null)
    {
        if (is_string($hatbeamer)) {
            $hatbeamer = in_array(strtolower($hatbeamer), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(RaumPeer::HATBEAMER, $hatbeamer, $comparison);
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
     * @return RaumQuery The current query, for fluid interface
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

        return $this->addUsingAlias(RaumPeer::JBEZ, $jbez, $comparison);
    }

    /**
     * Filter the query by a related Jahrgang object
     *
     * @param   Jahrgang|PropelObjectCollection $jahrgang The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 RaumQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByJahrgang($jahrgang, $comparison = null)
    {
        if ($jahrgang instanceof Jahrgang) {
            return $this
                ->addUsingAlias(RaumPeer::JBEZ, $jahrgang->getJbez(), $comparison);
        } elseif ($jahrgang instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RaumPeer::JBEZ, $jahrgang->toKeyValue('PrimaryKey', 'Jbez'), $comparison);
        } else {
            throw new PropelException('filterByJahrgang() only accepts arguments of type Jahrgang or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Jahrgang relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return RaumQuery The current query, for fluid interface
     */
    public function joinJahrgang($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Jahrgang');

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
            $this->addJoinObject($join, 'Jahrgang');
        }

        return $this;
    }

    /**
     * Use the Jahrgang relation Jahrgang object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   JahrgangQuery A secondary query class using the current class as primary query
     */
    public function useJahrgangQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinJahrgang($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Jahrgang', 'JahrgangQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Raum $raum Object to remove from the list of results
     *
     * @return RaumQuery The current query, for fluid interface
     */
    public function prune($raum = null)
    {
        if ($raum) {
            $this->addUsingAlias(RaumPeer::RNR, $raum->getRnr(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
