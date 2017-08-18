<?php

namespace MicroCMS\DAO;

use Doctrine\DBAL\Connection;
use MicroCMS\Domain\Competence;

class CompetenceDAO extends DAO
{
    /**
     * Return a list of all articles, sorted by date (most recent first).
     *
     * @return array A list of all articles.
     */
    public function findAll() {
        $sql = "select * from t_competences order by comp_id asc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $competences = array();
        foreach ($result as $row) {
            $competenceId = $row['comp_id'];
            $competences[$competenceId] = $this->buildDomainObject($row);
        }
        return $competences;
    }
    /**
     * Returns an article matching the supplied id.
     *
     * @param integer $id The article id.
     *
     * @return \MicroCMS\Domain\Article|throws an exception if no matching article is found
     */
    public function find($id) {
        $sql = "select * from t_competences where comp_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No competence matching id " . $id);
    }
    /**
     * Saves an article into the database.
     *
     * @param \MicroCMS\Domain\Article $article The article to save
     */
    public function save( Competence $competence ) {
        $competenceData = array(
            'comp_nom' => $competence->getNom(),
            'comp_valeur' => $competence->getValeur(),
            'comp_logo' => $competence->getLogo(),
            'comp_categorie' => $competence->getCategorie(),
            );

        if ($competence->getId()) {
            // The article has already been saved : update it
            $this->getDb()->update('t_competences', $competenceData, array( 'comp_id' => $competence->getId() ));
        } else {
            // The article has never been saved : insert it
            $this->getDb()->insert('t_competences', $competenceData);
            // Get the id of the newly created article and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $competence->setId($id);
        }
    }
    /**
     * Removes an article from the database.
     *
     * @param integer $id The article id.
     */
    public function delete($id) {
        // Delete the article
        $this->getDb()->delete('t_competences', array('comp_id' => $id));
    }
    /**
     * Creates an Experience object based on a DB row.
     *
     * @param array $row The DB row containing Article data.
     * @return \MicroCMS\Domain\Article
     */
    protected function buildDomainObject(array $row) {
        $competence = new Competence();
        $competence->setId($row['comp_id']);
        $competence->setNom($row['comp_nom']);
        $competence->setValeur($row['comp_valeur']);
        $competence->setLogo($row['comp_logo']);
        $competence->setCategorie($row['comp_categorie']);
        return $competence;
    }
}
