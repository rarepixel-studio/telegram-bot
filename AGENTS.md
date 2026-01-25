# Coding and Testing Standards

This document outlines the coding and testing standards for the Telegram Bot PHP SDK package. These guidelines should be followed to ensure code quality, maintainability, and consistency.

## Telegram Bot API Documentation

When implementing or modifying methods that interact with the Telegram Bot API, refer to the official API documentation located at `doc/telegram-bot-api.md`.

### How to Use the Documentation

- **Before implementing a new API method**: Read the corresponding section in `doc/telegram-bot-api.md` or check the online doc at `https://core.telegram.org/bots/api` to understand:
  - Required and optional parameters
  - Parameter types and constraints
  - Expected return types
  - Error conditions and error codes
  - Special notes or limitations
  - Follow the update workflow in `doc/telegram-bot-api-update-guide.md`

- **When refactoring existing methods**: Verify that the implementation matches the current API specification in the documentation.

- **When adding new object classes**: Check the documentation for the object structure, field types, and relationships to other objects.

- **When handling errors**: Reference the error codes and `ResponseParameters` structure documented in the API reference.

### Key Sections in the Documentation

- **Methods**: Each API method is documented with parameters, return types, and usage notes
- **Objects**: All Telegram Bot API objects are documented with their fields and types
- **Updates**: Information about update types and how to receive them
- **File Uploads**: Guidelines for handling file uploads and downloads

### Example Workflow

1. Identify the Telegram Bot API method you need to implement (e.g., `sendMessage`)
2. Search `doc/telegram-bot-api.md` for the method documentation
3. Review parameters, return types, and any special requirements
4. Implement the method following the coding standards in this document
5. Write tests that verify the implementation matches the API specification
6. Add PHPDoc comments that reference the official API documentation

## PHP Standards

### Type Declarations

- Always use explicit return type declarations for methods and functions.
- Always use explicit parameter type declarations for all method parameters.
- Always use explicit type declarations for all class properties.
- Use appropriate PHP type hints for method parameters and properties.
- Leverage PHP 8+ features like union types where appropriate.
- Use nullable types (`?Type`) for optional parameters and nullable properties.
- Note: `__construct()` and `__destruct()` cannot have return types in PHP.

**Example:**
```php
protected function isAccessible(User $user, ?string $path = null): bool
{
    // ...
}
```

**Parameter Type Requirements:**
- All method parameters must have explicit type declarations
- Use `?Type` for nullable parameters (e.g., `?string $token = null`)
- Use union types for parameters that accept multiple types (e.g., `string|int $id`)
- Array parameters should be typed as `array` (e.g., `array $params`)
- Closure parameters should be typed as `Closure` or `?Closure` for optional closures
- Avoid using `mixed` for parameters when a more specific type can be used

**Property Type Requirements:**
- All class properties must have explicit type declarations
- Use `?Type` for nullable properties (e.g., `?TelegramResponse $lastResponse = null`)
- Use union types for properties that can hold multiple types (e.g., `string|int $id`)
- Array properties should be typed as `array` (e.g., `array $waitingResponses = []`)
- Closure properties should be typed as `Closure` or `?Closure` for nullable closures
- Document property types in PHPDoc blocks using `@var` tags
- Initialize properties with appropriate default values that match their types

**Example:**
```php
/**
 * @var string
 */
protected string $accessToken;

/**
 * @var TelegramClient
 */
protected TelegramClient $client;

/**
 * @var TelegramResponse|null
 */
protected ?TelegramResponse $lastResponse = null;

/**
 * @var array<TelegramResponse>
 */
protected array $waitingResponses = [];

/**
 * @var Closure|null
 */
protected ?Closure $onSending = null;
```

### Constructors

- Use PHP 8 constructor property promotion in `__construct()` when appropriate.
- Do not allow empty `__construct()` methods with zero parameters.

**Example:**
```php
public function __construct(public TelegramClient $client) 
{
}
```

### Control Structures

- Always use curly braces for control structures, even if it has one line.

**Example:**
```php
if ($condition) {
    return true;
}
```

### Comments

- Prefer PHPDoc blocks over inline comments.
- Never use comments within the code itself unless there is something _very_ complex going on.
- Comments should explain "why", not "what" (code should be self-documenting).

### PHPDoc Blocks

- Add comprehensive PHPDoc blocks for all public and protected methods.
- Include parameter types, return types, and descriptions.
- Add useful array shape type definitions for arrays when appropriate.
- Use `@method` annotations for magic methods to improve IDE support.
- **MANDATORY**: Add `@throws` tags for all exceptions that can be thrown by the method.

**@throws Tag Requirements:**
- Add `@throws` tags for all exceptions that the method can throw directly
- Add `@throws` tags for exceptions thrown by methods called within (e.g., if calling `prepareResponse()`, add `@throws TelegramSDKException`)
- Document all exception types, not just the most common ones
- Include `@throws` even if the exception is thrown indirectly through helper methods
- Use fully qualified class names if the exception is from a different namespace (e.g., `@throws \InvalidArgumentException`)

**Example:**
```php
/**
 * Send a text message to a chat.
 *
 * @param array<string, mixed> $params Message parameters
 * @param int|string $params['chat_id'] Chat identifier
 * @param string $params['text'] Message text
 * @param string|null $params['parse_mode'] Optional parse mode
 * @return Message|Closure Message object or closure for async requests
 * @throws TelegramSDKException When API request fails or returns an error
 */
public function sendMessage(array $params): Message|Closure
{
    // ...
}
```

**Parameter Type Documentation:**
- Document all parameters with `@param` tags
- Include parameter types in `@param` tags even when type declarations exist (for IDE support)
- Use descriptive parameter names and descriptions
- For array parameters, document the expected structure using `@var` tags for array keys

### Enums

- Use enums for fixed sets of values.
- Follow existing application enum conventions for naming.

## Code Quality

### Naming Conventions

- Use descriptive names for variables and methods.
- Prefer clarity over brevity.
- Follow PSR-12 naming conventions:
  - Classes: `PascalCase`
  - Methods: `camelCase`
  - Properties: `camelCase`
  - Constants: `UPPER_SNAKE_CASE`

**Good Examples:**
- `isRegisteredForDiscounts` (not `discount()`)
- `getUserProfilePhotos()` (not `getPhotos()`)
- `sendMessage()` (clear and descriptive)

**Bad Examples:**
- `discount()` (unclear)
- `getPhotos()` (too generic)
- `msg()` (abbreviation)

### Code Structure

- Stick to existing directory structure - don't create new base folders without approval.
- Check for existing components to reuse before writing a new one.
- Follow existing code conventions used in the application.
- When creating or editing a file, check sibling files for the correct structure and approach.

### Verification

- Do not create verification scripts or debugging code when tests cover that functionality and prove it works.
- Unit and feature tests are more important than manual verification.

### Dependencies

- Do not change the package's dependencies without approval.
- Keep dependencies minimal and well-justified.

## Testing Standards

### Test Enforcement

- Every change must be programmatically tested.
- Write a new test or update an existing test for each change.
- Run the affected tests to ensure they pass before finalizing changes.
- Run the minimum number of tests needed to ensure code quality and speed.

### Test Coverage

- Aim for 100% test coverage.
- All new code must have corresponding tests.
- Gradually improve coverage of existing code.
- Use coverage reporting tools to identify gaps.

### Test Structure

- Use descriptive test method names that explain what is being tested.
- Follow the pattern: `test_it_[does_something]_when_[condition]` or `it_[does_something]_when_[condition]`.
- Group related tests in test classes.
- Use setUp() and tearDown() methods for common test setup.

**Example:**
```php
public function test_it_throws_exception_when_no_token_is_provided(): void
{
    $this->expectException(TelegramSDKException::class);
    new Api(null);
}

public function test_it_sends_message_successfully(): void
{
    // Arrange
    $api = new Api('token');
    $params = ['chat_id' => 123, 'text' => 'Hello'];
    
    // Act
    $result = $api->sendMessage($params);
    
    // Assert
    $this->assertInstanceOf(Message::class, $result);
}
```

### Test Types

- **Unit Tests**: Test individual classes and methods in isolation.
- **Integration Tests**: Test interactions between components.
- **Feature Tests**: Test complete features end-to-end.

### Test Data

- Use factories or builders for creating test data.
- Use descriptive variable names in tests.
- Avoid hardcoded values when possible - use constants or configuration.

### Mocking

- Mock external dependencies (HTTP clients, file systems, etc.).
- Use dependency injection to enable mocking.
- Prefer interfaces over concrete classes for better testability.

**Example:**
```php
public function test_it_handles_http_errors(): void
{
    $httpClient = Mockery::mock(HttpClientInterface::class);
    $httpClient->shouldReceive('send')
        ->andThrow(new NetworkException('Connection failed'));
    
    $api = new Api('token', false, $httpClient);
    
    $this->expectException(TelegramNetworkException::class);
    $api->sendMessage(['chat_id' => 123, 'text' => 'Hello']);
}
```

### Running Tests

- Run tests before committing changes.
- Use specific test filters to run only relevant tests during development.
- Ensure all tests pass before finalizing work.
- 
  === pint/core rules ===

## Laravel Pint Code Formatter

- You must run `vendor/bin/pint --dirty` before finalizing changes to ensure your code matches the project's expected style.
- NEVER run `vendor/bin/pint` without arguments as it will format the entire project (hundreds of files).
- To format specific files, use: `vendor/bin/pint path/to/file1.php path/to/file2.php`
- Always prefer `vendor/bin/pint --dirty` to only format files that have been modified.
- Do not run `vendor/bin/pint --test`, simply run `vendor/bin/pint --dirty` to fix any formatting issues.


## Documentation

### When to Create Documentation

- Only create documentation files if explicitly requested.
- Code should be self-documenting through:
  - Clear naming
  - PHPDoc blocks
  - Type hints
  - Tests (which serve as examples)

### Documentation Standards

- Keep documentation up-to-date with code changes.
- Use clear, concise language.
- Include code examples where helpful.
- Document public APIs thoroughly.

## Code Formatting

### Formatting Tools

- Use consistent code formatting.
- Run formatting tools before finalizing changes.
- Follow PSR-12 coding standards.

### Formatting Rules

- Use 4 spaces for indentation (no tabs).
- Remove trailing whitespace.
- Ensure consistent line endings.
- Keep lines to a reasonable length (typically 120 characters max).

## Error Handling

### Exception Usage

- Use specific exception types for different error conditions.
- Provide meaningful error messages.
- Include context in exception messages when helpful.
- Document exceptions in PHPDoc blocks using `@throws` tags (see PHPDoc Blocks section for requirements).

**Example:**
```php
/**
 * @throws TelegramSDKException When token is invalid
 * @throws TelegramNetworkException When network request fails
 * @throws TelegramResponseException When API returns an error
 */
public function sendMessage(array $params): Message
{
    // ...
}
```

**Note:** See the "PHPDoc Blocks" section for detailed requirements on `@throws` tags. All methods that throw exceptions or call methods that throw exceptions must document them with `@throws` tags.

## Concurrency and Async

### Async Requests

- Document when methods support async requests.
- Ensure proper handling of async responses.
- Test both sync and async code paths.

## Security

### Input Validation

- Validate all user inputs.
- Sanitize data before use.
- Use type hints and validation to prevent injection attacks.

### Sensitive Data

- Never log or expose sensitive data (tokens, passwords, etc.).
- Use secure methods for handling credentials.

## Performance

### Optimization

- Profile code before optimizing.
- Optimize only when there's a proven performance issue.
- Prefer readability over premature optimization.

### Best Practices

- Avoid N+1 query problems (if applicable to data fetching).
- Use appropriate data structures.
- Consider memory usage for large operations.

## Version Compatibility

### Backward Compatibility

- Maintain backward compatibility when possible.
- Document breaking changes clearly.
- Use semantic versioning appropriately.

### PHP Version

- Target PHP 8.0+ (as per composer.json requirements).
- Use modern PHP features when they improve code quality.
- Document minimum PHP version requirements.

## Code Review Checklist

Before submitting code, ensure:

- [ ] All tests pass
- [ ] New code has corresponding tests
- [ ] Code follows naming conventions
- [ ] PHPDoc blocks are complete
- [ ] Type hints are used throughout
- [ ] No Laravel-specific code (this is a standalone package)
- [ ] Error handling is appropriate
- [ ] Code is formatted consistently
- [ ] No debugging code or commented-out code
- [ ] Documentation is updated (if needed)

## Notes

- These standards are living guidelines - they may evolve as the project grows.
- When in doubt, follow existing code patterns in the codebase.
- Consistency is more important than perfection - follow the established patterns.

