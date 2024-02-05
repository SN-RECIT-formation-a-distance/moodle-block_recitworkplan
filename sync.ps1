$from = "moodle-block_recitworkplan/src/*"
$to = "shared/recitfad/blocks/recitworkplan"

try {
    . ("..\sync\watcher.ps1")
}
catch {
    Write-Host "Error while loading sync.ps1 script." 
}