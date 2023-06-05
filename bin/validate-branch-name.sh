#!/bin/bash

RED="\033[31m"
GREEN="\033[32m"
BLUE="\033[34m"
BOLD="\033[1m"
RESET="\033[0m"

PATTERN="^(cph)-?[0-9]+\/[a-zA-Z0-9]+(-[a-zA-Z0-9]+)*$"
BRANCH_NAME="$1"

if [[ "$BRANCH_NAME" =~ $PATTERN ]]; then
  exit 0
else
  echo -e "${RED}❗ Branch name ${BOLD}${BRANCH_NAME}${RESET} ${RED}does not match the expected pattern.${RESET}"
  echo -e "Valid branch name pattern: ${GREEN}<cph>-<NUMBER>/<DESCRIPTION>${RESET}"
  echo -e "In example: ${GREEN}cph-1234/test-branch-feature-xyz${RESET}."
  echo -e "To rename the current branch, run ${GREEN}git branch -m ${BOLD}<NEW_BRANCH_NAME>${RESET} in your terminal"
  echo -e "Exiting...\n"
  exit 1
fi
