# EPITECH_XP_CALCULATOR
Count the number of experience points for EPITECH's Hub module (for students).

## What this script tell about your hub module
- The number of xp you obtained
- The number of xp you lost
- The number of time you can still participate in talks or workshops or hackathons before reaching the limit
- The number of time you can still organize talks or workshops or hackathons before reaching the limit (if limit is 9999 for hackathons = unlimited, it won't display anything for hackathons)

## What is the result based on
1. Hub Talks (organization or participation)
2. Workshops (organization or participation)
3. Hackthons (organization or participation)

This programme doesn't take in account Hub projects and experimentations.

## Dependencies
1. php
2. php-curl (for ubuntu 20.* run: 'sudo apt install php-curl')

## How to use
1. Clone this repository
2. Navigate in the repository
3. Change the email and the year inside conf.json
4. Get your intranet Autologin link on this page https://intra.epitech.eu/admin/autolog
5. Create a file named "autologin" at the root of the repository
6. Copy the part f your autologin after 'https://intra.epitech.eu/'
(For example if my autologin is 'https://intra.epitech.eu/auth-6526' I need to copy 'auth-6526')
7. Past your what you have copied in the previously created file 'autologin' (on a single line, without new line at the end)
8. Run ./example at the root of the repository
(With the exmaple you can also use the argument '--details' for more details on your hub module)