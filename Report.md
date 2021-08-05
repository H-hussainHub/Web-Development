# Report

## Parsing
Parsing is a process of analyzing text that contains a sequence of tokens. This is to determine its grammatical structure, and the techniques for parsing are top-down parsing, bottom-up parsing and universal parsing. In addition, universal parsing is not generally used as it is not an efficient technique, whereas top-down and bottom-up parsing is the most commonly used parsing technique.

![Parsing](./Parsing.jpg)

Furthermore, a parse function allows the user to parse the data in one field in the source file then write those parts of the data to a field in the target file. Looking at tools for parsing, the XML parser is a package that provides an interface for client applications to work with XML documents. This package is used to check the format of an XML document and may also validate the document. The diagram below shows how an XML parser interacts with an XML document, and its goal is to transform XML into readable code.

![XMLParser](./XMLParser.jpg)

## Some XML parsing functions:

| Functions | Descriptions |
| ------ | ------ |
| [utf8_decode](https://www.php.net/manual/en/function.utf8-decode.php) | Converts a string with ISO-8859-1 characters encoded with UTF-8 to single-byte ISO-8859-1 |
| [utf8_encode](https://www.php.net/manual/en/function.utf8-encode.php) | Encodes an ISO-8859-1 string to UTF-8 |
| [xml_error_string](https://www.php.net/manual/en/function.xml-error-string.php) | Get XML parser error string |
| [xml_get_current_byte_index](https://www.php.net/manual/en/function.xml-get-current-byte-index.php) | Get current byte index for an XML parser |
| [xml_get_current_column_number](https://www.php.net/manual/en/function.xml-get-current-column-number.php) | Get current column number for an XML parser |
| [xml_parse_into_struct](https://www.php.net/manual/en/function.xml-parse-into-struct.php) | Parse XML data into an array structure |
| [xml_get_error_code](https://www.php.net/manual/en/function.xml-get-error-code.php) | Get XML parser error code |


## For parsing XML documents, there are two approaches to consider:
DOM loads all the documents, which provides maximum flexibility for developers as it makes it easy to navigate and parse.
Streaming avoids memory overkill as it iterates through the document like a cursor and stops at each element in its way.

## When to use Streaming Parser over DOM parser:
When it comes to large XML files, the streaming method is considered very useful. However, this method does not offer the same freedom of parsing as the DOM method, but it does get the job done and allows manipulation of the data very efficiently.

The DOM approach does not load the XML tree into memory as it iterates through the elements one by one. If an element to manipulate is no longer needed, then the cursor moves to the next element.

Furthermore, looking at XML processing models for example a DOM oriented parser SimpleXML() compared to stream-oriented parser XMLReader(). SimpleXML provides a simple and easily usable toolset to convert XML to an object that can be processed with array iterators and normal property selectors. This is an option when the HTML is valid as XHTML, but it will not work if this is used to parse broken HTML. Additionally, XMLReader is an extension of XML pull parser and pull streaming allows more flexibility when manipulating elements. So the reader acts as a cursor when going forward on the document stream and stopping at each element on the way. Using this is more advantageous as a user can easily move to the next element or go back to the previous element.

reflective:
I achieved the learning outcome for this assignment however the xml gave me trouble and the number of lines are incorrect for some of them. Nevertheless, for task 3 I provided the chart visualisation fully with not 1 pollutant shown but all three of them. In order to improve this and add more functionality to the chart I would take the data from 3 or more stations and compare the average against each station to provide which station gives off more pollution. Down below will be images of the two charts.

Line Chart:

![Linechart](./Linechart.jpg)

Scatter Chart:

![Scatterchart](./Scatterchart.jpg)

Finally here is the github link what provides all the codes and the data converted into csv stations then to xml (bear in mind for the charts you will need to run index.php):

[https://github.com/H-hussainHub/Web-Development.git]