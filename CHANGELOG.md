## [v0.0.4] 2025.12.10
### Added
* QR codes included in invitation emails, alongside the existing clickable links. ([d424544](https://github.com/noiteration/justinvite/commit/d424544))
* Users can now log in via API. ([84813f1](https://github.com/noiteration/justinvite/commit/84813f1))
* Test cases for API login and invitation modules. ([f80c7d8](https://github.com/noiteration/justinvite/commit/f80c7d8))

### Changed
* CSRF token is now available in a wider context, enabling secured forms to use it, whereas previously it was limited to forms submitted without logging in. ([32916c8](https://github.com/noiteration/justinvite/commit/32916c8))

## [v0.0.3] 2025.12.05
### Added
* Allow registered users to send invites via the dashboard. ([57dd10f](https://github.com/noiteration/justinvite/commit/57dd10f))

### Modified
* Update sidebar labels, and comment out unused code in dashboard. ([5dd8893](https://github.com/noiteration/justinvite/commit/5dd8893))
### Chores
* Removed unused variables flagged by linter. ([522d9bc](https://github.com/noiteration/justinvite/commit/522d9bc))
* Remove unused components. ([a58542e](https://github.com/noiteration/justinvite/commit/a58542e))

## [v0.0.2] 2025.12.04
### Fixes
* Fixed bug related to accepting invitations. ([e714429](https://github.com/noiteration/justinvite/commit/e714429))

### Added
* Outbound emails now queue in database for processing. ([7d379b5](https://github.com/noiteration/justinvite/commit/7d379b5))
* Emails can be now sent to users when they are invited. ([75ab89d](https://github.com/noiteration/justinvite/commit/75ab89d))


## [v0.0.1] 2025.12.03
### Added
* Invitations made unique. ([673bf14](https://github.com/noiteration/justinvite/commit/673bf14)), closes issue [#1](https://github.com/noiteration/justinvite/issues/1).
* Implemented invitation acceptance on the invited user's side. ([7475e7c](https://github.com/noiteration/justinvite/commit/7475e7c))
* Store invite in database via POST request. ([69f4194](https://github.com/noiteration/justinvite/commit/69f4194))
* User model now supports API tokens. ([9c3cb5a](https://github.com/noiteration/justinvite/commit/9c3cb5a))
* Installed Laravel Sanctum. ([edef28e](https://github.com/noiteration/justinvite/commit/edef28e))
* Added Invitation model, migration and controller. ([684aa43](https://github.com/noiteration/justinvite/commit/684aa43))

### Chores
* Comment registration tests for now. ([d7294bf](https://github.com/noiteration/justinvite/commit/d7294bf))
* Update README. ([927cc0b](https://github.com/noiteration/justinvite/commit/927cc0b))

### Initial Setup
* Fresh Laravel Install with React. ([18998ea](https://github.com/noiteration/justinvite/commit/18998ea))