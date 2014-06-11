<?php


/**
 * Base class that represents a query for the 'benutzer' table.
 *
 *
 *
 * @method BenutzerQuery orderByBname($order = Criteria::ASC) Order by the bname column
 * @method BenutzerQuery orderByPasswort($order = Criteria::ASC) Order by the passwort column
 * @method BenutzerQuery orderByIstadmin($order = Criteria::ASC) Order by the istAdmin column
 *
 * @method BenutzerQuery groupByBname() Group by the bname column
 * @method BenutzerQuery groupByPasswort() Group by the passwort column
 * @method BenutzerQuery groupByIstadmin() Group by the istAdmin column
 *
 * @method BenutzerQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method BenutzerQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method BenutzerQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Benutzer findOne(PropelPDO $con = null) Return the first Benutzer matching the query
 * @method Benutzer findOneOrCreate(PropelPDO $con = null) Return the first Benutzer matching the query, or a new Benutzer object populated from the query conditions when no match is found
 *
 * @method Benutzer findOneByPasswort(string $passwort) Return the first Benutzer filtered by the passwort column
 * @method Benutzer findOneByIstadmin(boolean $istAdmin) Return the first Benutzer filtered by the istAdmin column
 *
 * @method array findByBname(string $bname) Return Benutzer objects filtered by the bname column
 * @method array findByPasswort(string $passwort) Return Benutzer objects filtered by the passwort column
 * @method array findByIstadmin(boolean $istAdmin) Return Benutzer objects filtered by the istAdmin column
 *
 * @package    propel.generator..om
 */
abstract class BaseBenutzerQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseBenutzerQuery object.
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
            $modelName = 'Benutzer';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new BenutzerQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   BenutzerQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return BenutzerQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof BenutzerQuery) {
            return $criteria;
        }
        $query = new BenutzerQuery(null, null, $modelAlias);

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
     * @return   Benutzer|Benutzer[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = BenutzerPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(BenutzerPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Benutzer A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByBname($key, $con = null)
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
     * @return                 Benutzer A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `bname`, `passwort`, `istAdmin` FROM `benutzer` WHERE `bname` = :p0';
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
            $obj = new Benutzer();
            $obj->hydrate($row);
            BenutzerPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Benutzer|Benutzer[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Benutzer[]|mixed the list of results, formatted by the current formatter
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
     * @return BenutzerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(BenutzerPeer::BNAME, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return BenutzerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(BenutzerPeer::BNAME, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the bname column
     *
     * Example usage:
     * <code>
     * $query->filterByBname('fooValue');   // WHERE bname = 'fooValue'
     * $query->filterByBname('%fooValue%'); // WHERE bname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $bname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BenutzerQuery The current query, for fluid interface
     */
    public function filterByBname($bname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($bname)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $bname)) {
                $bname = str_replace('*', '%', $bname);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(BenutzerPeer::BNAME, $bname, $comparison);
    }

    /**
     * Filter the query on the passwort column
     *
     * Example usage:
     * <code>
     * $query->filterByPasswort('fooValue');   // WHERE passwort = 'fooValue'
     * $query->filterByPasswort('%fooValue%'); // WHERE passwort LIKE '%fooValue%'
     * </code>
     *
     * @param     string $passwort The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BenutzerQuery The current query, for fluid interface
     */
    public function filterByPasswort($passwort = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($passwort)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $passwort)) {
                $passwort = str_replace('*', '%', $passwort);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(BenutzerPeer::PASSWORT, $passwort, $comparison);
    }

    /**
     * Filter the query on the istAdmin column
     *
     * Example usage:
     * <code>
     * $query->filterByIstadmin(true); // WHERE istAdmin = true
     * $query->filterByIstadmin('yes'); // WHERE istAdmin = true
     * </code>
     *
     * @param     boolean|string $istadmin The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BenutzerQuery The current query, for fluid interface
     */
    public function filterByIstadmin($istadmin = null, $comparison = null)
    {
        if (is_string($istadmin)) {
            $istadmin = in_array(strtolower($istadmin), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(BenutzerPeer::ISTADMIN, $istadmin, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Benutzer $benutzer Object to remove from the list of results
     *
     * @return BenutzerQuery The current query, for fluid interface
     */
    public function prune($benutzer = null)
    {
        if ($benutzer) {
            $this->addUsingAlias(BenutzerPeer::BNAME, $benutzer->getBname(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
