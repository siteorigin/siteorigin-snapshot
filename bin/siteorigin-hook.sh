#!/usr/bin/env bash

set -euo pipefail

if [ $# -lt 1 ]; then
	echo "Usage: $0 <hook-name> [args]" >&2
	exit 1
fi

HOOK_NAME="$1"
shift || true

DEFAULT_PATH="$HOME/Sites/siteorigin-pre-commit"
BASE_PATH="${SITEORIGIN_PRE_COMMIT_PATH:-$DEFAULT_PATH}"

if [ ! -d "$BASE_PATH" ]; then
	echo "siteorigin-pre-commit not found."
	echo "Create it at $DEFAULT_PATH or set SITEORIGIN_PRE_COMMIT_PATH to its location." >&2
	exit 1
fi

HOOK_SCRIPT="$BASE_PATH/shared-hooks/pre-commit/${HOOK_NAME}.sh"

if [ ! -f "$HOOK_SCRIPT" ]; then
	echo "siteorigin-pre-commit hook '$HOOK_NAME' not found at $HOOK_SCRIPT" >&2
	exit 1
fi

if [ $# -gt 0 ]; then
	bash "$HOOK_SCRIPT" "$*"
else
	bash "$HOOK_SCRIPT"
fi
