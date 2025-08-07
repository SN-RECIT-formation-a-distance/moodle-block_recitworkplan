$from = "moodle-block_recitworkplan/src/*"
$to = "shared/recitfad3/blocks/recitworkplan"
$source = "./src";

try {
    . ("..\sync\watcher.ps1")
}
catch {
    Write-Host "Error while loading sync.ps1 script." 
}