<?php
if ( empty( $argv[1] ) )
{
	exit( 'Missing Sourcefile (main.js)' );
}

if ( empty( $argv[2] ) )
{
	exit( 'Missing Targetfile (main.js)' );
}

$source_file = trim( $argv[1] );
$target_file = trim( $argv[2] );

if ( !file_exists( $source_file ) )
{
	exit( 'Error opening Compiling-List.' );
}

echo 'SJSJ - Simple Javascript Joiner v0.1' . "\n";
echo 'Walter Szabo (www.dimeda.at)' . "\n\n";

$main_path = dirname( $argv[1] );
$temp = array();

foreach( file( $source_file ) as $line )
{
	preg_match( "/include '(.*)'/i", $line, $preg_match);

	if ( !empty( $preg_match[1] ) )
	{

		$include_file = $main_path . '\\' . trim( str_replace( '/', '\\', $preg_match[1] ) );

		if ( !file_exists( $include_file ) )
		{
			exit( 'Error opening Compiling-List-File: ' . $include_file );
		}

		echo "Parse File: " . basename( $include_file ) . "\n";
		$include_content = file( $include_file );
		$temp[] = "\n";
		$temp[] = "// Joined File: " . basename( $include_file );
		$temp[] = "\n";
		foreach( $include_content as $include_content_line )
		{
			if ( !empty( $include_content_line ) )
			{
				$temp[] = $include_content_line;
			}
		}
		$temp[] = "\n";
	}
	else
	{
		$temp[] = $line;
	}
}

if ( !$fp = fopen( $target_file, 'w+' ) )
{
	exit( 'Error during Compiling.' );
}

flock( $fp, 2 );
fwrite( $fp, join( '', $temp ) );
flock( $fp, 3 );
fclose( $fp );

echo "\nCompiling Done: " . $target_file . "\n\n";
sleep( 2 );
?>