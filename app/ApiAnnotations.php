
<?php
define("API_HOST",  config('swagger-lume.variables.host')); 
/**
 * @SWG\Swagger(
 *     basePath="/api/v1",
 *     schemes={"http"},
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="PROJECT TITLE",
 *         @SWG\Contact(
 *             email="your@email.com"
 *         ),
 *     )
 * )
 */

/**
 * @SWG\SecurityScheme(
 *   securityDefinition="api_key",
 *   type="apiKey",
 *   in="query",
 *   name="api_key"
 * )
 */