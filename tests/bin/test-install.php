<?php
/**
 * Installs the test environment
 *
 * @author Markus Malkusch <markus@malkusch.de>
 * @license WTFPL
 */

namespace malkusch\bav;

require_once __DIR__ . "/../bootstrap.php";

try {
    $isAutomaticInstallation = ConfigurationRegistry::getConfiguration()->isAutomaticInstallation();
    ConfigurationRegistry::getConfiguration()->setAutomaticInstallation(false);
    $databack = ConfigurationRegistry::getConfiguration()->getDatabackendContainer()->getDataBackend();

    // install file
    $databack->install();
    echo "Bundesbank file downloaded.\n";

    // install PDO
    $pdoContainer = new PDODataBackendContainer(PDOFactory::makePDO());

    try {
        $pdoContainer->getDataBackend()->install();
    } catch (\Exception $exception) {
        $pdoContainer->getDataBackend()->update();
    }

    echo "PDO installed.\n";

    // reset setting
    ConfigurationRegistry::getConfiguration()->setAutomaticInstallation($isAutomaticInstallation);
} catch (DataBackendException $error) {
    die("Installation failed: {$error->getMessage()}\n");

}

