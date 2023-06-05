/** @type {import('@commitlint/types').UserConfig} */
module.exports = {
    extends: ['@commitlint/config-conventional'],
    rules: {
        'type-enum': [
            2,
            'always',
            [
                'feat', //     New feature
                'fix', //      Bug fix
                'docs', //     Documentation changes
                'style', //    Changes that do not affect the meaning of the code (white-space, formatting, missing semi-colons, etc)
                'refactor', // Code changes that neither fixes a bug nor adds a feature
                'perf', //     A code change that improves performance
                'test', //     Adding missing tests or correcting existing tests
                'build', //    Changes that affect the build system or external dependencies
                'ci', //       CI related changes
                'chore', //    Changes to the build process or auxiliary tools and libraries such as documentation generation
                'revert', //   Reverts a previous commit
            ],
        ],
    },
};
